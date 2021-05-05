<div class="row">
    <style>
        .card-number a, .card-number a:hover {            
            text-decoration: none;
        }
    </style>
    
    @foreach($number as $item)
        <div class="col-lg-4 col-sm-6">
            <div class="card mx-2 my-2 card-number" style="width: 100%;">
                <!-- <img class="align-self-center img-thumbnail"  > -->
                <!-- <a href="{{ url('/order/create') }}?number={{ $item->number }}" title="View Number"  style="width:100%"> -->
                <a href="{{ url('/number/'.$item->number) }}" title="View Number"  style="width:100%">
                    <div class="card-body " >
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        <div class="row">                            
                            <div class="col-12 text-center ">                                
                                <div class="card-title text-center py-2" style="font-size: 24px;">
                                    <img src="{{ url('/') }}/img/operators/logo_{{ strtolower($item->operator) }}.jpg" class="" width="25%"  alt="...">
                                    {{ substr($item->number,0,3)."-".substr($item->number,3,3)."-".substr($item->number,6,4) }}
                                </div>                    
                            </div>                        
                        
                            <div class="col-6 text-center">                            
                                <label class="text-muted" style="font-size : 20px;">ผลรวม : {{ $item->total }}</label>
                            </div>
                            <div class="col-6 text-center">                            
                                <div class=" text-right px-4">                            
                                    <strong style="font-size : 20px;">{{ number_format($item->price,0) }}.- </strong>
                                </div>
                            </div>
                            
                        </div>                        

                    </div>
                </a>
                <!-- <div class="card-footer">
                    <small class="text-muted">ผลรวมเบอร์ : {{ $item->total }}</small>
                </div> -->
                <!-- <div class="">
                    @if( $item->status != "Reserved")
                    <a href="{{ url('/order/create') }}?number={{ $item->number }}" title="View Number" class="btn btn-danger btn-sm" style="width:100%"> <i class="fa fa-shopping-cart" aria-hidden="true"></i> สั่งซื้อ </a>
                    @else
                    {{$item->status}}
                    @endif                    
                
                </div> -->
            </div>  
                              
            
        </div>
    @endforeach
       
    
</div>
<div class="pagination-wrapper ">{!! $number->appends([
    'search' => Request::get('search'),
    'operator' => Request::get('operator'),
    'total' => Request::get('total'),
    'price' => Request::get('price'),
    'sort' => Request::get('sort','number'),
    'numbers' => $numbers,
    'whitelist' => Request::get('whitelist'),
    'blacklist' => Request::get('blacklist'),
])->onEachSide(1)->links() !!} </div>