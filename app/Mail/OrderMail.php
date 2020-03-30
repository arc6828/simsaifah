<?php

namespace App\Mail;
use App\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //order เดียว ไม่ต้องมี s ก็ได้ 
        $this->order = $order;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        return $this->subject('ลูกค้าสั่งซื้อเบอร์โทรศัพท์')
            ->view('order.mail', compact('order') );
            //หมายถึง order/mail.blade.php
    }
}
