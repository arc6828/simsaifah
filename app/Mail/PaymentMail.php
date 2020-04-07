<?php

namespace App\Mail;
use App\Payment;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        
        $this->payment = $payment;
    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $payment = $this->payment;
        return $this->subject('การสั่งซื้อเสร็จสมบูรณ์แล้ว')
            ->view('payment.paymentmail', compact('payment') );
            
    }
}
