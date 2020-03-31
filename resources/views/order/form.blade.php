<div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label for="number" class="control-label">{{ 'เบอร์ที่ท่านเลือก :' }}</label>
    <input class="form-control" name="number" type="text" id="number" value="{{ isset($order->number) ? $order->number : $number->number }}" >
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'ราคา' }}</label>
    <input class="form-control" name="price" type="number" id="price" value="{{ isset($order->price) ? $order->price  : $number->price }}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'ราคาทั้งหมด' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($order->total) ? $order->total  : '' }}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  {{ $errors->has('operator') ? 'has-error' : ''}}">
    <label for="operator" class="control-label" >{{ 'Operator' }}</label>
    <input class="form-control" name="operator" type="text" id="operator" value="{{ isset($order->operator) ? $order->operator : $number->operator}}" >
    {!! $errors->first('operator', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label ">{{ 'สถานะการจอง' }}</label>
    <!-- ตรงนี้ควรเป็นคำว่า "Checking" เพราะเมื่อสร้าง Order ขึ้นมาสถานะของ Order จะเป็น "Checking" -->
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($order->status) ? $order->status : 'Checking'}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label ">{{ 'ผู้ใช้งาน' }}</label>
    <input class="form-control d-none" name="user_id" type="number" id="user_id" value="{{ isset ($order->user_id) ? $order->user_id : Auth::user()->id }}" >
    <input class="form-control " name="user_name" type="text" id="user_name" value="{{ isset ($order->user_name) ? $order->user->name : Auth::user()->name}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none  {{ $errors->has('payment_id') ? 'has-error' : ''}}">
    <label for="payment_id" class="control-label">{{ 'payment_id'}}</label>
    <!-- payment ควรจะว่างเปล่า เพราะยังไม่ได้เกิดการชำระเงิน จะกลับมา อัพเดทภายหลัง ให้ d-none ไว้ -->
    <input class="form-control" name="payment_id" type="number" id="payment_id" value="{{ isset($order->payment_id) ? $order->payment_id : Auth::user()->id }}">
    {!! $errors->first('payment_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  d-none {{ $errors->has('remake') ? 'has-error' : ''}}">
    <label for="remake" class="control-label">{{ 'หมายเหตุ :' }}</label>
    <textarea class="form-control" rows="5" name="remake" type="textarea" id="remake" value=" {{ isset($order->remake) ? $order->remake : ''}}"> </textarea>
    {!! $errors->first('remake', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'ยืนยันการสั่งซื้อ' }}">
</div>
