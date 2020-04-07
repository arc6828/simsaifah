<h1>การสั่งซื้อเสร็จสมบูรณ์แล้ว: ทาง Shop ขอขอบคุณ คุณ {{ $payment->user->name }} ในการสั่งซื้อเบอร์ </h1>
<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <th>หมายเลขชำระเงิน</th><td>{{ $payment->id }}</td>
            </tr>
            <tr><th> ยอดรวม </th><td> {{ $payment->total }} </td></tr>
            <tr><th> สถานะ </th><td> {{ $payment->status }} </td></tr>
            <tr><th> เลขพัสดุจัดส่ง </th><td> {{ $payment->tracking_number }}  </td></tr>
        </tbody>
    </table>
</div>
