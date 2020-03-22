<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="control-label">{{ 'ประเภท' }}</label>
    <select name="category" class="form-control" id="category" >
    @foreach (json_decode('{"\u0e42\u0e2d\u0e19":"\u0e42\u0e2d\u0e19\u0e1c\u0e48\u0e32\u0e19\u0e18\u0e19\u0e32\u0e04\u0e32\u0e23","\u0e1a\u0e31\u0e15\u0e23\u0e40\u0e04\u0e23\u0e14\u0e34\u0e15":"\u0e1a\u0e31\u0e15\u0e23\u0e40\u0e04\u0e23\u0e14\u0e34\u0e15 (+3%)","\u0e40\u0e01\u0e47\u0e1a\u0e40\u0e07\u0e34\u0e19\u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07":"\u0e40\u0e01\u0e47\u0e1a\u0e40\u0e07\u0e34\u0e19\u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($payment->category) && $payment->category == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
    <label for="discount" class="control-label">{{ 'ส่วนลด' }}</label>
    <input class="form-control" name="discount" type="number" id="discount" value="{{ isset($payment->discount) ? $payment->discount : ''}}" >
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dept') ? 'has-error' : ''}}">
    <label for="dept" class="control-label">{{ 'Dept' }}</label>
    <input class="form-control" name="dept" type="number" id="dept" value="{{ isset($payment->dept) ? $payment->dept : ''}}" >
    {!! $errors->first('dept', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('total') ? 'has-error' : ''}}">
    <label for="total" class="control-label">{{ 'ยอดรวม' }}</label>
    <input class="form-control" name="total" type="number" id="total" value="{{ isset($payment->total) ? $payment->total : ''}}" >
    {!! $errors->first('total', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($payment->status) ? $payment->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tracking_number') ? 'has-error' : ''}}">
    <label for="tracking_number" class="control-label">{{ 'Tracking Number' }}</label>
    <input class="form-control" name="tracking_number" type="number" id="tracking_number" value="{{ isset($payment->tracking_number) ? $payment->tracking_number : ''}}" >
    {!! $errors->first('tracking_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank') ? 'has-error' : ''}}">
    <label for="bank" class="control-label">{{ 'ธนาคาร' }}</label>
    <input class="form-control" name="bank" type="text" id="bank" value="{{ isset($payment->bank) ? $payment->bank : ''}}" >
    {!! $errors->first('bank', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('slip') ? 'has-error' : ''}}">
    <label for="slip" class="control-label">{{ 'หลักฐานการโอน' }}</label>
    <input class="form-control" name="slip" type="file" id="slip" value="{{ isset($payment->slip) ? $payment->slip : ''}}" >
    {!! $errors->first('slip', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('order_id') ? 'has-error' : ''}}">
    <label for="order_id" class="control-label">{{ 'Order Id' }}</label>
    <input class="form-control" name="order_id" type="number" id="order_id" value="{{ isset($payment->order_id) ? $payment->order_id : ''}}" >
    {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($payment->user_id) ? $payment->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
