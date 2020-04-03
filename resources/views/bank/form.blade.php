<div class="form-group {{ $errors->has('account_name') ? 'has-error' : ''}}">
    <label for="account_name" class="control-label">{{ 'ชื่อบัญชี' }}</label>
    <input class="form-control" name="account_name" type="text" id="account_name" value="{{ isset($bank->account_name) ? $bank->account_name : ''}}" >
    {!! $errors->first('account_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('account_number') ? 'has-error' : ''}}">
    <label for="account_number" class="control-label">{{ 'เลขที่บัญชี' }}</label>
    <input class="form-control" name="account_number" type="text" id="account_number" value="{{ isset($bank->account_number) ? $bank->account_number : ''}}" >
    {!! $errors->first('account_number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_name') ? 'has-error' : ''}}">
    <label for="bank_name" class="control-label">{{ 'ธนาคาร' }}</label>
    <input class="form-control" name="bank_name" type="text" id="bank_name" value="{{ isset($bank->bank_name) ? $bank->bank_name : ''}}" >
    {!! $errors->first('bank_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($bank->user_id) ? $bank->user_id : Auth::id() }}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($bank->remark) ? $bank->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="text" id="status" value="{{ isset($bank->status) ? $bank->status : ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
