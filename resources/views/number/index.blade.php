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
                                    <label for=""><i class="fa fa-search"></i> ค้นหาเบอร์</label>
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
                                    <label for=""><i class="fa fa-signal"></i> ค่ายมือถือ</label>
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
                                    <label for=""><i class="fa fa-birthday-cake"></i> ตามวันเกิด</label>
                                    <select name="birthday" id="birthday" class="form-control" >
                                        <option value="" >ทั้งหมด</option>   
                                        @php
                                            $birthdays = [
                                                "sun" => "เกิดวันอาทิตย์",
                                                "mon" => "เกิดวันจันทร์",
                                                "tue" => "เกิดวันอังคาร",
                                                "wed" => "เกิดวันพุธ",
                                                "thu" => "เกิดวันพฤหัส",
                                                "fri" => "เกิดวันศุกร์",
                                                "saa" => "เกิดวันเสาร์",
                                            ];
                                        @endphp
                                        @foreach($birthdays as $key => $value) 
                                        <option value="{{ $key }}" {{ request('birthday') == ($key) ? 'selected' : ''  }} >{{ $value }} </option>
                                        @endforeach
                                    </select>
                                    <input type="password" class="form-control d-none" id="exampleInputPassword1">
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for=""><i class="fa fa-align-justify"></i> ผลรวมเบอร์</label>
                                    <select name="total" id="total" class="form-control" >
                                        <option value="" >ทั้งหมด</option>                                    
                                        @foreach($total_array as $t) 
                                        <option value="{{ $t->total }}" {{ request('total') == ($t->total) ? 'selected' : ''  }} >{{ $t->total }} (มี {{ number_format($t->count,0) }} รายการ)</option>
                                        @endforeach
                                    </select>
                                    <input type="password" class="form-control d-none" id="exampleInputPassword1">
                                </div>
                                

                                <div class="form-group col-lg-12">                                
                                    <label for=""><i class="fa fa-tags"></i> ค้นหาจากราคา</label>
                                    <select name="price" id="price" class="form-control" >
                                        <option value="1000000" >ทุกราคา</option>                                    
                                        @foreach([1000,1500,2000,2500,3000,4000,5000,8000,10000,20000] as $i)
                                        <option value="{{ $i }}" {{ request('price') == $i ? 'selected' : ''  }}>ไม่เกิน {{ number_format($i,0) }}</option>
                                        @endforeach                                    
                                    </select>                                  
                                </div>

                                <div class="form-group col-lg-12">                                
                                    <label for=""><i class="fa fa-sort"></i> เรียงลำดับ</label>
                                    <select name="sort" id="sort" class="form-control" >
                                        <option value="number" {{ request('sort') == 'number' ? 'selected' : ''  }}>หมายเลขเบอร์</option>
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : ''  }}>ราคาจากน้อยไปหามาก</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : ''  }}>ราคาจากมากไปหาน้อย</option>                                     
                                                                   
                                    </select>                                  
                                </div>
                            
                            </div>

                            <div class="form-group">
                                
                                <label for=""><i class="fa fa-asterisk"></i> ระบุตัวเลขตามตำแหน่ง</label>
                                <div class="my-container" style="flex-direction:row; display: flex;" >
                                @php
                                $numbers = ["","","","","","","","","","","",""];
                                if( is_array(request('numbers')) ){                                    
                                    $numbers = request('numbers');                                    
                                    //print_r( $numbers);
                                }
                                @endphp
                                @for($i=0; $i< 10; $i++) 
                                    
                                    @php
                                        $numbers[$i] =  isset($numbers[$i])? $numbers[$i] : '';
                                        $numbers[$i] = ($i==0)?"0":$numbers[$i];
                                    @endphp
                                    
                                    <div style="flex:5; padding:0 1px; ">
                                        <input style="text-align: center;" align="middle" class="number-sm digit" type="text"  name="numbers[]" onkeydown="" maxlength="1" value="{{ isset($numbers[$i])? $numbers[$i] : '' }}" pattern="[0-9]*" >                                                                                 
                                    </div>
                                    
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
                                        // console.log(target.value,maxLength,myLength,next);
                                        // console.log(next.parentNode);
                                        // console.log(next.parentNode.nextElementSibling);
                                        // console.log(next.parentNode.nextElementSibling.firstElementChild );
                                        while (next = next.parentNode.nextElementSibling.firstElementChild) {                                            
                                            
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
                                        while (previous = previous.parentNode.previousElementSibling.firstElementChild) {
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
                            <div class="form-group ">                                
                                <label for="">
                                    <i class="fa fa-check"></i> 
                                    เลขที่ต้องการ 
                                    <span class="text-secondary" data-toggle="tooltip" data-placement="top" title="ตัวอย่างเช่น 55, 88, 99 เป็นต้น">
                                        <i class="fa fa-question-circle"></i> 
                                    </span> 
                                </label>
                                <input type="text" class="form-control" id="whitelist" name="whitelist" value="{{ request('whitelist') }}" >
                                                              
                            </div>
                            <div class="form-group">                                
                                <label for="">
                                    <i class="fa fa-times"></i> 
                                    เลขที่ไม่ต้องการ
                                    <span class="text-secondary" data-toggle="tooltip" data-placement="top" title="ตัวอย่างเช่น 00, 11 เป็นต้น">
                                        <i class="fa fa-question-circle"></i> 
                                    </span> 
                                </label>
                                <input type="text" class="form-control" id="blacklist" name="blacklist" value="{{ request('blacklist') }}">
                                
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
                            <li class=""><a href="{{ url('/number') }}?price=1000">	เบอร์ราคาไม่เกิน 1,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=1500">	เบอร์ราคาไม่เกิน 1,500฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=2000">	เบอร์ราคาไม่เกิน 2,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=2500">	เบอร์ราคาไม่เกิน 2,500฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=3000">	เบอร์ราคาไม่เกิน 3,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=4000">	เบอร์ราคาไม่เกิน 4,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=5000">	เบอร์ราคาไม่เกิน 5,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=8000">	เบอร์ราคาไม่เกิน 8,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=10000">	เบอร์ราคาไม่เกิน 10,000฿</a></li>
                            <li class=""><a href="{{ url('/number') }}?price=20000">	เบอร์ราคาไม่เกิน 20,000฿</a></li>
                            <hr/>
                           
                            <li class=""><a href="{{ url('/number') }}?whitelist=16%2C61%2C161%2C616">เบอร์งานบัญชี ธุรการ</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=48%2C84%2C58%2C85%2C68%2C86%2C88%2C782%2C828">เบอร์อาชีพสีเทา</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=22%2C44%2C46%2C246%2C424%2C626%2C636">เบอร์ข้าราชการ พนักงาน</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=19%2C91%2C23%2C32%2C29%2C92%2C192%2C193%2C291">เบอร์ดารา นักแสดง</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=35%2C359%2C515%2C535%2C539">เบอร์ทนายความ</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=14%2C41%2C15%2C51%2C145%2C149%2C154%2C415%2C451%2C514">เบอร์นักเรียน นักศึกษา</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=35%2C359%2C515%2C535%2C539">เบอร์นิติกร อัยการ ผู้พิพากษา</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=789%2C987%2C879%2C978">เบอร์มังกร 789 อำนาจเงินก้อน</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=29%2C292%2C782%2C829">เบอร์วิศวกร ช่าง เบอร์สถาปัต การออกแบบ</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=289%2C982%2C928%2C829">เบอร์หงส์ 289 เสน่ห์เงินก้อน</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=24%2C42%2C424">เบอร์เสน่ห์ เมตตามหานิยม</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=639%2C539%2C939%2C936%2C935">เบอร์โกยทรัพย์ 639 539 939</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=456%2C565%2C654%2C656">เลขมหาโชค 456 565</a></li>
                            <li class=""><a href="{{ url('/number') }}?whitelist=45%2C54%2C95%2C99%2C59%2C55">เบอร์สุขภาพ ผู้สูงอายุ</a></li>
                            <hr/>
                            <li class=""><a href="{{ url('/number') }}?birthday=sun">เบอร์เกิดวันอาทิตย์</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=mon">เบอร์เกิดวันจันทร์</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=tue">เบอร์เกิดวันอังคาร</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=wed">เบอร์เกิดวันพุธ</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=thu">เบอร์เกิดวันพฤหัส</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=fri">เบอร์เกิดวันศุกร์</a></li>
                            <li class=""><a href="{{ url('/number') }}?birthday=sat">เบอร์เกิดวันเสาร์</a></li>
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
                        <h4>
                            ผลการค้นหาเบอร์โทรศัพท์ 
                            @foreach($tags as $t)
                                @if($t != "")
                                <span class="badge badge-warning">{{ $t }}</span>
                                @endif
                            @endforeach
                        </h4> 
                        <div>
                            
                        </div>
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
                                            
                                            
                                            
                                            
                                            <h5 class="mt-0">{{ substr($item->number,0,3)."-".substr($item->number,3,3)."-".substr($item->number,6,4) }}</h5>
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
                                'sort' => Request::get('sort','number'),
                                'numbers' => $numbers,
                                'whitelist' => Request::get('whitelist'),
                                'blacklist' => Request::get('blacklist'),
                            ])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection


