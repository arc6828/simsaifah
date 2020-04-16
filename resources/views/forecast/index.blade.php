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
                            <div class="form-group col-lg-6">
                                <label for="">กรุณาระบุเบอร์ที่คุณต้องการทำนาย (ตัวเลข 10 หลัก)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="tel" placeholder="" value="{{ request('tel') }}" autocomplete="off" pattern="[0-9]{10}">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">วันที่ (วันที่ เดือน ปี)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="date" placeholder="" value="{{ request('date') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">เวลา (ชั่วโมง)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="hour" placeholder="" value="{{ request('hour') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">เวลา (นาที)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="minute" placeholder="" value="{{ request('minute') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg">
                                <label for="">คะแนนของเบอร์</label><br>
                                {{ $forecast }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg">
                                <a class="btn btn-outline-success" href="{{ url('/forecast') }}" >ยกเลิก</a>
                                <button class="btn btn-success" type="submit">ทำนายเบอร์</button>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-lg">
                                <label for="">คำทำนาย</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="predict" placeholder="" value="{{ request('predict') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-lg">
                                <label for="">Radar Chart</label>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


