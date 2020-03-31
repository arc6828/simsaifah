<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Number;
use App\Order;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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
            

        if (!empty($keyword)) {
            $payment = Payment::where('category', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->orWhere('dept', 'LIKE', "%$keyword%")
                ->orWhere('total', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->orWhere('tracking_number', 'LIKE', "%$keyword%")
                ->orWhere('bank', 'LIKE', "%$keyword%")
                ->orWhere('slip', 'LIKE', "%$keyword%")
                ->orWhere('order_id', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $payment = Payment::latest()->paginate($perPage);
        }
            

        return view('payment.index', compact('payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request) 
    {
        //เราไม่ได้รับค่าจาก url
        //$order_keyword = $request->get('payment_id'); 
        //เราไม่ได้ต้องการ อัพเดท เราแค่ query ออกมา
        
        //ดึงค่า user_id ของผู้ที่ Login
        $user_id = Auth::id(); //
        
        // เตรียม order ที่มีสถานะ จองเบอร์ “Successful”
        $orders = Order::where('user_id', $user_id) //เราต้องการดึงค่า Order ที่มี สถานะ เป็น successful และ ถูกสร้าง โดย ผู้ที่ Login 
            ->where('status','successful')
            ->get(); //OK
        // ส่ง Order มาแสดงที่ Blade
        return view('payment.create',compact('orders'));
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
        //อัพโหลดหลักฐานการโอนเงิน
        $requestData = $request->all();
        if ($request->hasFile('slip')) {
            $requestData['slip'] = $request->file('slip')
                ->store('uploads', 'public');
        }        
        $requestData['chackpayment_at'] = date('Y-m-d H:i:s');
         //สร้าง payment
        $payment = Payment::create($requestData);
        //ดึงค่า user_id ของผู้ที่ Login
        $user_id = Auth::id(); //
        //อัพเดท "payment_id ล่าสุด" ใน order ที่มีสถานะ เป็น successful
        Order::where('user_id', $user_id) //เราต้องการดึงค่า Order ที่มี สถานะ เป็น successful และ ถูกสร้าง โดย ผู้ที่ Login 
            ->where('status','successful')
            ->update(['payment_id' => $payment->id ]); //อัพเดท payment_id ที่อยู่ในตาราง order 

           
            //เราต้องการอัพเดท payment_id ใน order ของเราไง เรียบร้อย
            //id ที่ว่านี้คือของ order ใช่ไหมคะ
            //payment_id ในตาราง Order
        

        return redirect('payment')->with('flash_message', 'Payment added!');
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
        $payment = Payment::findOrFail($id);

        return view('payment.show', compact('payment'));
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
        $payment = Payment::findOrFail($id);

        return view('payment.edit', compact('payment'));
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
        if ($request->hasFile('slip')) {
            $requestData['slip'] = $request->file('slip')
                ->store('uploads', 'public');
        }
        if(!empty($requestData['status'])){
            switch($requestData['status']){
                case "chackpayment" : 
                    $requestData['chackpayment_at'] = date('Y-m-d H:i:s');
                    break;    
                case "paid" : 
                    $requestData['paid_at'] = date('Y-m-d H:i:s');
                    break;                      
                case "delivery" : 
                    $requestData['delivery_at'] = date('Y-m-d H:i:s');
                    break;    
                case "cancel" : 
                    $requestData['cancel_at'] = date('Y-m-d H:i:s');
                    break;   
            }
        }

        $payment = Payment::findOrFail($id);
        $payment->update($requestData);

        return redirect('payment')->with('flash_message', 'Payment updated!');
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
        Payment::destroy($id);

        return redirect('payment')->with('flash_message', 'Payment deleted!');
    }
}
