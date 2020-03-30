@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">ประวัติการชำระเงิน</div>
                    <div class="card-body">
                        <a href="{{ url('/payment/create') }}" class="btn btn-success btn-sm" title="Add New Payment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/payment') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                      

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="d-none">ประเภทการโอน</th>
                                        <th class="d-none">ส่วนลด</th>
                                        <th class="d-none">Dept</th>
                                        <th class="d-none">ยอดรวม</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>หลักฐานการโอนเงิน</th>
                                        <th class="d-none">Bank</th>
                                        <th>เลขจัดส่ง</th>
                                        <th class="d-none">User Id</th>
                                        <th>สถานะ</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($payment as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="d-none">{{ $item->category }}</td>
                                        <td class="d-none">{{ $item->discount }}</td>
                                        <td class="d-none">{{ $item->dept }}</td>
                                        <!--เป็นการดึงข้อมูล 1 payment สามารถมีหลาย orders โดยดึงผ่าน $item 
                                        เพราะ payment/index ไม่รู้จัก orders-->
                                        <td> 
                                             @foreach( $item->orders as $order ) 
                                                <div>{{ $order->number }}</div>
                                             @endforeach
                                            
                                        </td> 
                                        <td class="d-none">{{ $item->total }}</td>
                                        <td class="d-none">{{ $item->bank }}</td>
                                        <td><img src="{{asset('/storage')}}/{{$item->slip}}" width="100"></td>
                                        <td>{{ $item->tracking_number }}</td>
                                        <td class="d-none">{{ $item->user_id }}</td>      
                                        <td>
                                            @switch( $item->status ) 
                                                @case("chackpayment")
                                                    <div><span class="badge badge-secondary">กำลังตรวจสอบ</span></div>
                                                    <div>{{ $item->chackpayment_at }}</div>
                                                @break

                                                @case("paid")
                                                    <div><span class="badge badge-info">เตรียมการจัดส่ง</span></div>
                                                    <div>{{ $item->paid_at }}</div>
                                                @break
                                                            
                                                @case("delivery")
                                                    <div><span class="badge badge-success">จัดส่งแล้ว</span></div>
                                                    <div>{{ $item->delivery_at }}</div>
                                                @break

                                                @case("cancel")
                                                    <div><span class="badge badge-danger">ยกเลิกการจัดส่ง</span></div>
                                                    <div>{{ $item->cancelpayment_at }}</div>
                                                @break

                                            @endswitch 
                                       
                                        
                                            <form method="POST" action="  {{ url('/payment') . '/' . $item->id}} accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}

                                            @switch($item->status)
                                                @case("chackpayment")
                                                    <input type="hidden" name="status" value="booked">  </input>
                                                    <select name="status" onchange="">
                                                        <option value="paid">เตรียมการจัดส่ง </option>
                                                        <option value="delivery">จัดส่งเบอร์โทร </option>
                                                        <option value="cancel">ยกเลิกการจัดส่ง </option>
                                                    </select>
                                                    <input name="tracking_number" class="form-control" value="">
                                                    <button type="submit" class="btn btn-warning btn-sm"> submit </button>
                                                @break
                                            @endswitch
                                            </form>
                                        </td>   

                                        <td>
                                            <a href="{{ url('/payment/' . $item->id) }}" title="View Payment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/payment/' . $item->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <form method="POST" action="{{ url('/payment' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Payment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $payment->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
