@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">ทำนายเบอร์</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/forecast') }}" accept-charset="UTF-8" class="" role="search">
                        <div class="row">    
                            <div class="form-group col-lg">
                                <label for="">กรุณาระบุเบอร์ที่คุณต้องการทำนาย (ตัวเลข 10 หลัก)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tel" placeholder="" value="{{ request('tel') }}" autocomplete="off" pattern="[0-9]{10}">
                                    <span class="input-group-append">
                                        <button class="btn btn-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg">
                                <label for="">คะแนนของเบอร์</label><br>
                                {{ $forecast }}
                            </div>
                        </div>
                        <a class="btn btn-outline-success" href="{{ url('/forecast') }}" >Reset</a>
                        <button class="btn btn-success" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


