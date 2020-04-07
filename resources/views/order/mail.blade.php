<h1>คำสั่งซื้อหมายเลข : Shop {{ $order->id }}, คุณ {{ $order->user->name }} ได้สั่งซื้อเบอร์ {{ $order->number }} กับทางร้าน</h1>
<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
                <th>หมายเลขสั่งซื้อ</th><td>{{ $order->id }}</td>
            </tr>
            <tr><th>เบอร์ที่ท่านสั่งซื้อ</th><td>{{ $order->number }}</td></tr>
            <tr><th>ราคา</th><td> {{ $order->price }} </td></tr>
            <tr><th>ยอดรวม</th><td> {{ $order->total }} </td></tr>
            <tr><th>สถานะ</th><td> {{ $order->status }} </td></tr>
            <tr><th>เครือข่าย</th><td> {{ $order->operator }} </td></tr>
            <tr><th>อีมเล์ลูกค้า</th><td> {{ $order->user->email }} </td></tr>
            <tr><th>ลูกค้า</th><td> {{ $order->user->name }} </td></tr>
            <tr><th>เบอร์ติดต่อลูกค้า</th><td> {{ $order->user->phone }} </td></tr>
            
            <tr><th>ตรวจสอบการจองได้ที่</th><td> {{ url('/order') }} </td></tr>
        </tbody>
    </table>
</div>