@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">รวมเบอร์จองทั้งหมด</div>
                    <div class="card-body">
                        <!-- ชื่อว่าจองเบอร์เพิ่มก็จริง แต่ให้ไปโผล่ที่ number จะดีกว่า -->
                        <a href="{{ url('/number') }}" class="btn btn-danger btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> จองเบอร์เพิ่ม </a>
                            <!-- อันนี้ OK-->
                        <a href="{{ url('/payment/create') }}" class="btn btn-danger btn-sm" title="Add New Order">
                            <i class="fa fa-plus" aria-hidden="true"></i> แจ้งการชำระเงิน </a>

                        <form method="GET" action="{{ url('/order') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-success" type="submit">
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
                                        <th>เวลาจอง</th>
                                        <th>ค่ายมือถือ</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ราคา</th>
                                        <th class="d-none">ราคารวม</th>
                                        <th class="d-none">Operator</th>
                                        <th class="d-none">payment</th>
                                        <th>ผู้จอง</th>
                                        <th>สถานะ</th> 
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }}</td> 
                                        <td >{{ $item->created_at }}</td>
                                        <td class="d-none">{{ $item->remake }}</td>
                                        <td> {{ $item->operator }}</td>
                                        <td> {{ $item->number }}</td>
                                        <td> {{ $item->price }}</td>
                                        <td class="d-none"> {{ $item->total }}</td>
                                        <td class="d-none"> {{ $item->operator }}</td>
                                        <td class="d-none"> {{ $item->payment_id}}</td>
                                        <td> {{ $item->user->name }}</td>
                                        <td>
                                            @switch( $item->status )
                                                @case("bookedorder")
                                                    <div><span class="badge badge-primary">กำลังตรวจสอบ</span></div>
                                                    <div>{{ $item->bookedorder_at }}</div>
                                                    @break

                                                            
                                                @case("successful")
                                                
                                                    <div><span class="badge badge-success">จองเบอร์แล้ว</span></div>
                                                    <div>{{ $item->successful_at }}</div>
                                                
                                                    @break
                                                @case("paid")
                                                
                                                    <div><span class="badge badge-primary">ชำระเงินแล้ว</span></div>
                                                    <div>{{ $item->paid_at }}</div>
                                                
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
                                                @case("bookedorder") <!--เปลี่ยนสถานะ Order เป็น “succesful-->
                                                    @if(Auth::user()->role == "admin")
                                                        <input type="hidden" name="number" value="{{$item->number}}">
                                                        <select name="status" onchange="">
                                                            <option value="successful">จองเบอร์แล้ว </option>
                                                            <option value="cancel">ยกเลิกการจองเบอร์ </option>
                                                        </select>
                                                        <button type="submit" class="btn btn-success btn-sm"> submit</button>
                                                    @endif    
                                                @break
                                            @endswitch
                                        </form>
                                        </td>       
                                        <td class="d-none">
                                        
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
