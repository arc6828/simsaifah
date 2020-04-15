@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="" ><img src="{{ url('img/test-cover.jpg') }}" width="100%"></div>
        <div class="row mt-4">
            
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header">ตัวกรองเบอร์โทรศัพท์</div>
                    <div class="card-body">
                        <form method="GET" action="{{ url('/number') }}" accept-charset="UTF-8" class="" role="search">

                            <div class="row ">    
                                <div class="form-group col-lg">
                                    <label for="">ค้นหาเบอร์</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" autocomplete="off">
                                        <span class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>    
                                </div>   
                            </div>

                            <div class="row">                                                   

                                <div class="form-group col-lg">
                                    <label for="">ค่ายมือถือ</label>
                                    <select name="operator" id="operator" class="form-control" >
                                        <option value="" >ทั้งหมด</option>                                    
                                        @foreach($operator_array as $op)
                                        <option 
                                            value="{{ $op->operator }}" 
                                            style="background-image:url({{ url('/') }}/img/operators/logo_{{ $op->operator }}.jpg); background-repeat: no-repeat, repeat;" 
                                            {{ request('operator') == $op->operator ? 'selected' : ''  }} >
                                            {{ $op->operator }} ({{ number_format($op->count,0) }} รายการ)
                                        </option>
                                        @endforeach                                    
                                    </select>                                
                                </div>

                                <div class="form-group col-lg">
                                    <label for="">ผลรวมเบอร์</label>
                                    <select name="total" id="total" class="form-control" >
                                        <option value="" >ทั้งหมด</option>                                    
                                        @foreach($total_array as $t) 
                                        <option value="{{ $t->total }}" {{ request('total') == ($t->total) ? 'selected' : ''  }} >{{ $t->total }} (มี {{ number_format($t->count,0) }} รายการ)</option>
                                        @endforeach
                                    </select>
                                    <input type="password" class="form-control d-none" id="exampleInputPassword1">
                                </div>
                                

                                <div class="form-group col-lg">                                
                                    <label for="">ค้นหาจากราคา</label>
                                    <select name="price" id="price" class="form-control" >
                                        <option value="1000000" >ทุกราคา</option>                                    
                                        @for($i=80000; $i>1000; $i=$i/2)
                                        <option value="{{ $i }}" {{ request('price') == $i ? 'selected' : ''  }}>ไม่เกิน {{ number_format($i,0) }}</option>
                                        @endfor                                    
                                    </select>                                  
                                </div>

                                <div class="form-group col-lg">                                
                                    <label for="">เรียงจากราคา</label>
                                    <select name="sort" id="sort" class="form-control" >
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : ''  }}>น้อยไปหามาก</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : ''  }}>มากไปหาน้อย</option>                                     
                                                                   
                                    </select>                                  
                                </div>
                            
                            </div>

                            <div class="form-group">
                                
                                <label for="">ระบุตัวเลขตามตำแหน่ง</label>
                                <div class="my-container">
                                @php
                                $numbers = ["","","","","","","","","","","",""];
                                if( is_array(request('numbers')) ){                                    
                                    $numbers = request('numbers');                                    
                                    //print_r( $numbers);
                                }
                                @endphp
                                @for($i=0; $i< 12; $i++) 
                                    
                                    @php
                                        $numbers[$i] =  isset($numbers[$i])? $numbers[$i] : '';
                                    @endphp
                                    @if($i==3 || $i==7) 
                                        -<input class="number-sm dash" type="hidden"  name="numbers[]" value="-">
                                    @else
                                        <input class="number-sm digit"  name="numbers[]" onkeydown="" maxlength="1" value="{{ isset($numbers[$i])? $numbers[$i] : '' }}">
                                    @endif
                                @endfor                              
                                </div>
                                
                                <style>
                                    .number-sm{
                                        width:20px;
                                    }
                                </style>
                                <script>
                                
                                var container = document.getElementsByClassName("my-container")[0];
                                container.onkeyup = function(e) {
                                    var target = e.srcElement || e.target;
                                    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
                                    var myLength = target.value.length;
                                    if (myLength >= maxLength) {
                                        var next = target;
                                        while (next = next.nextElementSibling) {
                                            if (next == null)
                                                break;
                                            if (next.tagName.toLowerCase() === "input" && next.classList.contains('digit')) {
                                                next.focus();
                                                break;
                                            }
                                        }
                                    }
                                    // Move to previous field if empty (user pressed backspace)
                                    else if (myLength === 0) {
                                        var previous = target;
                                        while (previous = previous.previousElementSibling) {
                                            if (previous == null)
                                                break;
                                            if (previous.tagName.toLowerCase() === "input") {
                                                previous.focus();
                                                break;
                                            }
                                        }
                                    }
                                } 
                                </script>
                            </div>


                            

                            <a class="btn btn-outline-primary" href="{{ url('/number') }}" >Reset</a> 
                            <button class="btn btn-primary" type="submit">Submit</button>     
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">ผลการค้นหาเบอร์โทรศัพท์</div>
                    <div class="card-body ">    
                        <div class="table-responsive table-striped">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="d-none">#</th>
                                        <th>ค่ายมือถือ</th>
                                        <th>เบอร์โทรศัพท์</th><th>ราคา</th>
                                        <th>ผลรวม</th>
                                        <th  class="d-none"></th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($number as $item)
                                    <tr>
                                        <td  class="d-none">{{ $loop->iteration }}</td>
                                        <td><img src="{{ url('/') }}/img/operators/logo_{{ strtolower($item->operator) }}.jpg" width="50"></td>
                                        <td><h5>{{ $item->number }}</h5></td>
                                        <td>{{ number_format($item->price,0) }}.-</td>
                                        <td>{{ $item->total }}</td>
                                        <td class="d-none">{{$item->status}}</td>
                                        <td>
                                            <!-- ตรงนี้ต้องแนบเบอร์ ไปหน้า create ด้วย -->
                                            @if( $item->status != "Reserved")
                                            <a href="{{ url('/order/create') }}?number={{ $item->number }}" title="View Number"><button class="btn btn-success btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> สั่งซื้อ</button></a>
                                            @else
                                            {{$item->status}}
                                            @endif
                                            <a class="d-none" href="{{ url('/number/' . $item->id) }}" title="View Number"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a class="d-none" href="{{ url('/number/' . $item->id . '/edit') }}" title="Edit Number"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form  class="d-none" method="POST" action="{{ url('/number' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm d-none" title="Delete Number" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper ">{!! $number->appends([
                                'search' => Request::get('search'),
                                'operator' => Request::get('operator'),
                                'total' => Request::get('total'),
                                'price' => Request::get('price'),
                                'sort' => Request::get('sort','asc'),
                                'numbers' => $numbers,
                            ])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-md-3">
                สำหรับ sidebar 
            </div>
        </div>
    </div>

@endsection


