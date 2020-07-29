<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label for="role" class="control-label">{{ 'Role' }}</label>
    <input class="form-control" name="role" type="text" id="role" value="{{ isset($user->role) ? $user->role : ''}}" >
    {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'เบอร์โทรศัพท์' }}</label>
    <input class="form-control" name="phone" type="number" id="phone" value="{{ isset($user->phone) ? $user->phone : ''}}" >    
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group  {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control d-none" name="user_id" type="number" id="user_id" value="{{ isset($user->user_id) ? $user->user_id : Auth::user()->id}}" >
    <input class="form-control" name="user_name" type="text" id="user_name" value="{{ isset ($order->user_id) ? $order->user->name : Auth::user()->name}}" readonly>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
