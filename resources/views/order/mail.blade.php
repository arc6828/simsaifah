<h1>Hi,  Shop {{ $order->id }} ได้สั่งซื้อเบอร์</h1>
<div class="table-responsive">
    <table class="table">
        <tbody>
            <tr>
            <th>หมายเลขสั่งซื้อ</th><td>{{ $order->id }}</td>
            <tr><th>เบอร์ที่ท่านสั่งซื้อ</th><td>{{ $order->number }}</td></tr>
            <tr><th>ราคา</th><td> {{ $order->price }} </td></tr>
            <tr><th>ยอดรวม</th><td> {{ $order->total }} </td></tr>
            <tr><th>สถานะ</th><td> {{ $order->status }} </td></tr>
            <tr><th>เครือข่าย</th><td> {{ $order->operator }} </td></tr>
            </tr>
        </tbody>
    </table>
</div>