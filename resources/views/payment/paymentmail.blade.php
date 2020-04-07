<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <th>หมายเลขจ่ายเงิน</th><td>{{ $payment->id }}</td>
            </tr>
            <tr><th> ยอดรวม </th><td> {{ $payment->total }} </td></tr>
            <tr><th> สถานะ </th><td> {{ $payment->status }} </td></tr>
            <tr><th> เลขพัสดุจัดส่ง </th><td> {{ $payment->tracking_number }}  </td></tr>
        </tbody>
    </table>
</div>
