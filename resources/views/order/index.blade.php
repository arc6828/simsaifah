@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">รวมเบอร์จองทั้งหมด</div>
                    <div class="card-body">
                        <a href="{{ url('/order/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> จองเบอร์เพิ่ม </a>
                        <a href="{{ url('/payment/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> แจ้งการชำระเงิน </a>

                        <form method="GET" action="{{ url('/order') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th class="d-none">#</th>
                                        <th>ค่าย</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ราคา</th>
                                        <th>ราคารวม</th>
                                        <th>Operator</th>
                                        <th>สถานะ</th> 
                                        <th class="d-none">User Id</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                    
                                        <td class="d-none">{{ $loop->iteration }}</td> 
                                        <td>{{ $item->remake }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>{{ $item->operator }}</td>
                                        <td class="d-none">{{ $item->user_id }}</td>
                                        <td>
                                            @switch( $item->status )
                                                @case("booked")
                                                    <div><span class="badge badge-primary">กำลังตรวจสอบ</span></div>
                                                    <div>{{ $item->bookedorder_at }}</div>
                                                @break
                                                            
                                                @case("successful")
                                                    <div><span class="badge badge-success">จองเบอร์แล้ว</span></div>
                                                    <div>{{ $item->successful_at }}</div>
                                                @break

                                                @case("cancel")
                                                    <div><span class="badge badge-danger">ยกเลิกการจองเบอร์</span></div>
                                                    <div>{{ $item->cancel_at }}</div>
                                                @break

                                            @endswitch 
                                            
                                        </td>
                                        <td>
                                        <form method="POST" action="  {{url('/order') . '/' . $item->id}} accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}

                                            @switch($item->status)
                                                @case("booked")
                                                    <input type="hidden" name="status" value="booked">  </input>
                                                    <select name="status" onchange="">
                                                        <option value="successful">จองเบอร์แล้ว </option>
                                                        <option value="cancel">ยกเลิกการจองเบอร์ </option>
                                                    </select>
                                                    <button type="submit" class="btn btn-warning btn-sm"> submit</button>
                                                @break
                                            @endswitch
                                        </form>
                                        </td>       
                                        <td>

                                            <a href="{{ url('/order/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/order/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/order' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Order" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
            
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $order->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
