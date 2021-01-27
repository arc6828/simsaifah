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