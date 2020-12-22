@extends('layouts.app')

@section('content')
    <div class="container">
    
        <div class="row mt-4">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5>ตัวกรองเบอร์โทรศัพท์</h5>
                        <form method="GET" action="{{ url('/number') }}" accept-charset="UTF-8" class="" role="search">

                            <div class="row mt-4">    
                                <div class="form-group col-lg">
                                    <label for="">ค้นหาเบอร์</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}" autocomplete="off">
                                        <span class="input-group-append">
                                            <button class="btn btn-danger" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>    
                                </div>   
                            </div>

                            <div class="row">                                                   

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
                                    <label for="">ผลรวมเบอร์</label>
                                    <select name="total" id="total" class="form-control" >
                                        <option value="" >ทั้งหมด</option>                                    
                                        @foreach($total_array as $t) 
                                        <option value="{{ $t->total }}" {{ request('total') == ($t->total) ? 'selected' : ''  }} >{{ $t->total }} (มี {{ number_format($t->count,0) }} รายการ)</option>
                                        @endforeach
                                    </select>
                                    <input type="password" class="form-control d-none" id="exampleInputPassword1">
                                </div>
                                

                                <div class="form-group col-lg-12">                                
                                    <label for="">ค้นหาจากราคา</label>
                                    <select name="price" id="price" class="form-control" >
                                        <option value="1000000" >ทุกราคา</option>                                    
                                        @for($i=80000; $i>1000; $i=$i/2)
                                        <option value="{{ $i }}" {{ request('price') == $i ? 'selected' : ''  }}>ไม่เกิน {{ number_format($i,0) }}</option>
                                        @endfor                                    
                                    </select>                                  
                                </div>

                                <div class="form-group col-lg-12">                                
                                    <label for="">เรียงจากราคา</label>
                                    <select name="sort" id="sort" class="form-control" >
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : ''  }}>น้อยไปหามาก</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : ''  }}>มากไปหาน้อย</option>                                     
                                                                   
                                    </select>                                  
                                </div>
                            
                            </div>

                            <div class="form-group">
                                
                                <label for="">ระบุตัวเลขตามตำแหน่ง</label>
                                <div class="my-container" style="flex-direction:row; display: flex;" >
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
                                        <div style="flex:1; padding:0 1px;"><input style="text-align: center;" align="middle" class="number-sm dash" type="text"  name="numbers[]" value="-"  readonly> </div>
                                    @else
                                        <div style="flex:5; padding:0 1px; "><input style="text-align: center;" align="middle" class="number-sm digit" type="text"  name="numbers[]" onkeydown="" maxlength="1" value="{{ isset($numbers[$i])? $numbers[$i] : '' }}" pattern="[0-9]*" > </div>
                                    @endif
                                @endfor                              
                                </div>
                                
                                <style>
                                    .number-sm{
                                        width:100%;
                                    }
                                    input[type=number]::-webkit-inner-spin-button, 
                                    input[type=number]::-webkit-outer-spin-button { 
                                        -webkit-appearance: none; 
                                        margin: 0; 
                                    }
                                    .dash{
                                        border: none;
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
                                        while (next = next.parentNode.nextElementSibling.firstChild) {
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
                                        while (previous = previous.parentNode.previousElementSibling.firstChild) {
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


                            

                            <a class="btn btn-outline-danger" href="{{ url('/number') }}" >ล้าง</a> 
                            <button class="btn btn-danger" type="submit">ค้นหา</button>     
                        </form>

                    </div>
                </div>
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <h5>เมนูลัด</h5>
                        <ul>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=1000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 1,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=1500&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 1,500฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=2000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 2,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=2500&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 2,500฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=3000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 3,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=4000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 4,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=5000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 5,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=8000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 8,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=10000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 10,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?search=&operator=&total=&price=20000&sort=asc&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=-&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=&numbers%5B%5D=">	เบอร์ราคาไม่เกิน 20,000฿</a></li>
                            <hr/>
                            <li class=""><a href="#">เบอร์มงคลสวย เบอร์มงคลพิเศษ VIP</a></li>
                            <li class=""><a href="#">เบอร์มงคลตอง XXX</a></li>
                            <li class=""><a href="#">เบอร์มงคลเลขสลับ XYXY</a></li>
                            <li class=""><a href="#">เบอร์มงคลเลขคู่ XXYY</a></li>
                            <li class=""><a href="#">เบอร์มงคลเลขหาบ XYYX</a></li>
                            <li class=""><a href="#">เบอร์มงคลเลขเรียง 456 / 654</a></li>
                            <li class=""><a href="#">เบอร์มงคลเลขเรียง 789 / 987</a></li>
                            <li class=""><a href="#">เบอร์โฟร์หน้า เลข4ตัวเหมือน</a></li>
                            <li class=""><a href="#">เบอร์สลับ3ชุด</a></li>
                            <li class=""><a href="#">เบอร์สามคู่</a></li>
                            <!-- <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 1,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 2,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 3,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 4,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 5,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 8,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 10,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 15,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาไม่เกิน 20,000 บาท</a></li>
                            <li class=""><a href="#">เบอร์มงคลราคาเกิน 20,000 บาท</a></li> -->
                        </ul>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-lg-9">                

                <div class="card">
                    <div class="card-body ">   
                        @if(Auth::check())
                            @switch(Auth::user()->role)
                                @case("admin")                                    
                                    @include('number/import-modal')
                                    @break
                            @endswitch  
                        @endif
                        <h4>ผลการค้นหาเบอร์โทรศัพท์</h4> 
                        <div class="table-responsive mt-4">
                            <table class="table table-dark table-striped  table-hover">
                                <thead>
                                    <tr >
                                        <th class="d-none">#</th>
                                        <th class="d-lg-block d-md-none d-sm-none d-none text-center">ค่ายมือถือ</th>
                                        <th class="text-center">เบอร์โทรศัพท์</th>
                                        <th>ราคา</th>
                                        <th  class="d-none"></th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($number as $item)
                                    <tr>
                                        <td  class="d-none">{{ $loop->iteration }}</td>
                                        <td  class="d-lg-block d-md-none d-sm-none d-none  text-center">
                                            <img class="align-self-center img-thumbnail" src="{{ url('/') }}/img/operators/logo_{{ strtolower($item->operator) }}.jpg" width="100%" style="max-width:80px;">
                                        </td>
                                        <td class="text-center">
                                            
                                            
                                            
                                            
                                            <h5 class="mt-0">{{ $item->number }}</h5>
                                            <div><strong>ผลรวมเบอร์ : {{ $item->total }}</strong></div>
                                            <img class="d-lg-none img-thumbnail" src="{{ url('/') }}/img/operators/logo_{{ strtolower($item->operator) }}.jpg" width="100%" style="max-width:50px;">
                                            
                                            
                                        </td>
                                        <td >{{ number_format($item->price,0) }}.-</td>
                                        <td class="d-none">{{$item->status}}</td>
                                        <td>
                                            <!-- ตรงนี้ต้องแนบเบอร์ ไปหน้า create ด้วย -->
                                            @if( $item->status != "Reserved")
                                            <a href="{{ url('/order/create') }}?number={{ $item->number }}" title="View Number"><button class="btn btn-danger btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> สั่งซื้อ</button></a>
                                            @else
                                            {{$item->status}}
                                            @endif
                                            <a class="d-none" href="{{ url('/number/' . $item->id) }}" title="View Number"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a class="d-none" href="{{ url('/number/' . $item->id . '/edit') }}" title="Edit Number"><button class="btn btn-danger btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

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
            
        </div>
    </div>

@endsection


