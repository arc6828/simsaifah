<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Number;
use App\Mail\OrderMail;
use App\Mail\CancelMail;
use App\Mail\GuestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        //1. แสดง Order ที่มีสถานะ “Checking”

        switch(Auth::user()->role){
            case "admin" : //แอดมินจะเห็นทั้งหมด
                if (!empty($keyword)) { //แอดมิน
                    $order = Order::where('number', 'LIKE', "%$keyword%")
                        ->orWhere('price', 'LIKE', "%$keyword%")
                        ->orWhere('total', 'LIKE', "%$keyword%")
                        ->orWhere('status', 'LIKE', "%$keyword%")
                        ->orWhere('operator', 'LIKE', "%$keyword%")
                        ->orWhere('remake', 'LIKE', "%$keyword%")
                        ->orWhere('user_id', 'LIKE', "%$keyword%")
                        ->latest()->paginate($perPage);
                } else {
                    
                    $order = Order::latest()->paginate($perPage);
                }
            break;

            default : // guest ผู้ใช้เห็นแค่ของตนเอง
                if (!empty($keyword)) {
                    $order = Order::where('user_id', Auth::user()->id)
                        ->where(function($query) use ($keyword){
                    $query
                        ->where('number', 'LIKE', "%$keyword%")
                        ->orWhere('price', 'LIKE', "%$keyword%")
                        ->orWhere('total', 'LIKE', "%$keyword%")
                        ->orWhere('status', 'LIKE', "%$keyword%")
                        ->orWhere('operator', 'LIKE', "%$keyword%")
                        ->orWhere('remake', 'LIKE', "%$keyword%")
                        ->orWhere('user_id', 'LIKE', "%$keyword%");
                        
                        })
                        ->latest()->paginate($perPage); 
                } else {
                    $order= Order::where('user_id' , Auth::user()->id)->latest()->paginate($perPage);
                }
        }
        return view('order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        /* 2. จองเบอร์ให้
            order/crate จะมาโผล่ที่นี่
            เราจะต้องดึงข้อมูล number ขึ้นแล้วส่งไปแสดงในหน้า view 
        */
        $number_keyword = $request->get('number');//ดึงnumber จาก url : order/create?number=08x-xxx-xxxx
        //ดึงข้อมูล where ขึ้นมาเฉพาะเบอร์ที่เราต้องการ 
        $number = Number::where('number',$number_keyword)->firstOrFail(); //FirstOrFail หมายถึง ถ้าเจอหลายตัวให้ดึงตัวแรก แต่ถ้าไม่เจอสักตัวให้ 404
        // echo $number->number;
        // exit();
        $bt = file_get_contents("https://berlnw.com/reserve/".str_replace("-","",$number->number)."/step-1");
        $bt = explode("textarea",$bt)[1];
        $bt = explode(">",$bt)[1];
        $bt = explode("<",$bt)[0];
        // echo $bt;
        

        
        return view('order.create',compact('number','bt'));//compact เพื่อส่งไปยังไน้า blade
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //เวลาทำให้เอา Flowchart มาเขียน คอมเม้นท์ที่ในโค้ดก่อน จากนั้นให้เอาโค้ดที่มีอยู่แล้วมาเติมจากนั้นเราจะเติมโค้ดใส่ส่วนที่ไม่มี
        //CRUD Generator ไม่ได้ให้มาทุกอย่าง ยังไงก็ต้องเขียนเพื่มอยู่ดี

        //1.ทำการจองเบอร์ [OK]
        $requestData = $request->all();        
        $requestData['bookedorder_at'] = date("Y-m-d H:i:s");
        $order = Order::create($requestData);

        //2.เปลี่ยนสถานะ "number" เป็น “Reserved” ต้องดูก่อนว่า number มีคอลัมน์สถานะมั้ย [OK]
        Number::where('number',$order->number) //YES
            ->update([
                'status'=>'Reserved',                
                'reserved_at'=>date("Y-m-d H:i:s"),
                ]); //รายละเอียดอยู่ในสไลด์

        //3.อัพเดท เบอร์โทรผู้ใช้ในตาราง user [OK]
        User::where('id',$order->user_id) //YES
            ->update([ 'phone'=> $requestData['phone'] ]);
            
        //4.ทำการส่งเมลแจ้งเตือนร้านค้า   ตรงนี้ OK ยัง ยังไม่สมบูรณ์ค่ะ ปิดไม่ก่อนไม่ซีเรียส
            $this->ordermail($order->id); //เป็นการส่งอีเมลหลังจากมีการ create order 1 ครั้ง

        return redirect('order')->with('flash_message', 'Order added!');
    }
    public function orderMail($id)
    {
        $order = Order::findOrFail($id);
        //ใส่ Mail ร้านค้า ควรใส่เมล์จริงๆ  ใส่เมล์ของแป้งเลย สมมติว่าแป้งเป็นเจ้าของร้าน 
        //$email = "pangza880@gmail.com";
        $users = User::where('role','admin')->get();
        foreach($users as $user){
            $email = $user->email;
            Mail::to($email)
                //->cc('scarlets1150@gmail.com')
                ->send(new OrderMail($order));   
        }
    }

    public function cancelMail($id)
    {
        $order = Order::findOrFail($id);
        $users = User::where('role','guest')->get();
        {
            $email = $order->user->email;
            Mail::to($email)
                ->send(new CancelMail($order));   
        }
    }

    public function guestMail($id)
    {
        $order = Order::findOrFail($id);
        $users = User::where('role','guest')->get();
        {
            $email = $order->user->email; //เป็นการเรียกใช้ข้อมูล order ในตาราง user คอลั้ม email
            Mail::to($email)
                ->send(new GuestMail($order));   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
       
        $requestData = $request->all();
        //เตรียมอัพเดทสถานะ และเวลา
        if(!empty($requestData['status'])){
            $order = Order::findOrFail($id); // เป็นการเขียนให้ update รู้จัก order 
            switch($requestData['status']){//
                case "bookedorder" : 
                    $requestData['bookedorder_at'] = date('Y-m-d H:i:s');
                    break;    
                case "successful" : 
                    $requestData['successful_at'] = date('Y-m-d H:i:s');
                    //$this->orderMail($order->id); // เมื่อเป็น successful จะส่งอีเมล ทำการสั่งซื้อ
                    break;    
                case "cancel" : 
                    $requestData['cancel_at'] = date('Y-m-d H:i:s');    
                    //$this->cancelMail($order->id);    // เมื่อเป็น cancel จะส่งอีเมล ยกเลิกการสั่งซื้อ
                    //ต้องไป set status ใน ตาราง number ว่าเป็น ""
                    Number::where('number',$requestData['number'])->update(["status"=>""]);
                    break;   
            }// เป็นการเขียนอัพเดทสถานะแบบยังไม่ได้ส่งอีเมล
        }
        //อัพเดทสถานะ
        $order = Order::findOrFail($id);
        $order->update($requestData);

        //ส่งอีเมล์
        if(!empty($requestData['status'])){
            $order = Order::findOrFail($id); // เป็นการเขียนให้ update รู้จัก order
            switch($requestData['status']){
                case "successful" : 
                    $this->guestmail($order->id); // เมื่อเป็น successful จะส่งอีเมล ทำการสั่งซื้อ
                    break;    
                case "cancel" :   
                    $this->cancelMail($order->id);
                    break;   
            }
        }

        return redirect('order')->with('flash_message', 'Order updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect('order')->with('flash_message', 'Order deleted!');
    }
}
