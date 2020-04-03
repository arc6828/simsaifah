<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;
use App\Number;
use App\Mail\OrderMail;
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
            
        
        return view('order.create',compact('number'));//compact เพื่อส่งไปยังไน้า blade
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


        //3.ทำการส่งเมลแจ้งเตือนร้านค้า   ตรงนี้ OK ยัง ยังไม่สมบูรณ์ค่ะ ปิดไม่ก่อนไม่ซีเรียส
        $this->orderMail($order->id);

        return redirect('order')->with('flash_message', 'Order added!');
    }
    public function orderMail($id)
    {
        $order = Order::findOrFail($id);
        //ใส่ Mail ร้านค้า ควรใส่เมล์จริงๆ  ใส่เมล์ของแป้งเลย สมมติว่าแป้งเป็นเจ้าของร้าน 
        //$email = "pangza880@gmail.com";
        $users = User::where('role','admin')->get();
        foreach($users as $user){
            //เหมือนยังไม่ได้ทำ Mail ใช่ป่ะ ใช่ค่ะยัง เราใช้ชื่อว่า OrderMail
            $email = $user->email;
            Mail::to($email)
                ->cc('scarlets1150@gmail.com')
                ->send(new OrderMail($order));   
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
        if(!empty($requestData['status'])){
            switch($requestData['status']){
                case "bookedorder" : 
                    $requestData['bookedorder_at'] = date('Y-m-d H:i:s');
                    break;    
                case "successful" : 
                    $requestData['successful_at'] = date('Y-m-d H:i:s');
                    break;    
                case "cancel" : 
                    $requestData['cancel_at'] = date('Y-m-d H:i:s');                    
                    //ต้องไป set status ใน ตาราง number ว่าเป็น ""
                    Number::where('number',$requestData['number'])->update(["status"=>""]);
                    break;   
            }
        }
        
        $order = Order::findOrFail($id);
        $order->update($requestData);

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
