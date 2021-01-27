<div class="row">
    
    @foreach($number as $item)
        <div class="col-lg-4">
            <div class="card mx-2 my-2" style="width: 100%;">
                <img src="{{ url('/') }}/img/operators/logo_{{ strtolower($item->operator) }}.jpg" class="card-img-top p-4" alt="...">
                <!-- <img class="align-self-center img-thumbnail"  width="100%"  > -->
                <div class="card-body " >
                    <h4 class="card-title">{{ substr($item->number,0,3)."-".substr($item->number,3,3)."-".substr($item->number,6,4) }}</h4>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <div class="card-text ">
                        <div class="row">
                            <div class="col-lg-6">                            
                                <strong style="font-size : 18px;">{{ number_format($item->price,0) }}.- </strong>
                            </div>
                            
                            <div class="col-lg-6 text-right">
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
                            
                            </div>
                        </div>

                        
                    </div>
                    
                    <div class="card-text">
                        
                    </div>

                </div>
                <div class="card-footer">
                    <small class="text-muted">ผลรวมเบอร์ : {{ $item->total }}</small>
                </div>
            </div>                    
            
        </div>
    @endforeach
       
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