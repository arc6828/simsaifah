<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ชื่อ - นามสกุล' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($address->name) ? $address->name : ''}}" required >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'ที่อยู่' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($address->address) ? $address->address : ''}}" required>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none {{ $errors->has('company') ? 'has-error' : ''}}">
    <label for="company" class="control-label">{{ 'ที่อยู่บริษัท' }}</label>
    <input class="form-control" name="company" type="text" id="company" value="{{ isset($address->company) ? $address->company : ''}}"  >
    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parish') ? 'has-error' : ''}}">
    <label for="parish" class="control-label">{{ 'ตำบล' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="parish" type="text" id="parish" value="{{ isset($address->parish) ? $address->parish : ''}}" required >
    {!! $errors->first('parish', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    <label for="district" class="control-label">{{ 'อำเภอ' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="district" type="text" id="district" value="{{ isset($address->district) ? $address->district : ''}}" required >
    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
    <label for="province" class="control-label">{{ 'จังหวัด' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="province" type="text" id="province" value="{{ isset($address->province) ? $address->province : ''}}" required >
    {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('postal') ? 'has-error' : ''}}">
    <label for="postal" class="control-label">{{ 'ไปรษณีย์' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="postal" type="text" id="postal" value="{{ isset($address->postal) ? $address->postal : ''}}" required >
    {!! $errors->first('postal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contact') ? 'has-error' : ''}}">
    <label for="contact" class="control-label">{{ 'ติดต่อ' }} <span class="text-danger">*</span></label>
    <input class="form-control" name="contact" type="text" id="contact" value="{{ isset($address->contact) ? $address->contact : ''}}" required >
    {!! $errors->first('contact', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remake') ? 'has-error' : ''}}">
    <label for="remake" class="control-label">{{ 'หมายเหตุ' }} </label>
    <textarea class="form-control" rows="5" name="remake" type="textarea" id="remake" >{{ isset($address->remake) ? $address->remake : ''}}</textarea>
    {!! $errors->first('remake', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group d-none" {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="number" id="user_id" value="{{ isset($address->user_id) ? $address->user_id : Auth::id() }}" required >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
