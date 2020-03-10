@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Number</div>
                    <div class="card-body">
                        <a href="{{ url('/number/create') }}" class="btn btn-success btn-sm" title="Add New Number">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/number') }}" accept-charset="UTF-8" class="" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <style>
                                .number-sm{
                                    width:20px;
                                }
                                </style>
                                <div class="row">
                                    <div class="col-lg-3">by ตำแหน่ง</div>
                                    <div class="col-lg-9">
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]"> - 
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]"> - 
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]">
                                        <input class="number-sm"  name="number[]">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-3">by Price Range</div>
                                    <div class="col-lg-9">
                                        <select name="range" id="range">
                                            <?php foreach([1000,1500,2000,2500,3000,3500,4000,4500,5000] as $price){ ?> 
                                            <option value="<?=$price ?>" {{ request('range') == $price ? 'selected' : ''  }}>น้อยกว่า <?=$price ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>        
                                
                                <div class="row">
                                    <div class="col-lg-3">by ผลรวม</div>
                                    <div class="col-lg-9">
                                        <select name="sum" >
                                            <?php for($i=9; $i<=81; $i++){ ?> 
                                            <option value="<?=$i ?>" {{ request('sum') == $i ? 'selected' : ''  }} ><?=$i ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="row">
                                    <div class="col-lg-3">by Operator</div>
                                    <div class="col-lg-9">
                                        <select name="operator" id="operator">
                                            <?php foreach(["ais","dtac","truemove"] as $operator){ ?> 
                                            <option value="<?=$operator ?>" {{ request('operator') == $operator ? 'selected' : ''  }}><?=$operator ?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>   
                                <button class="btn btn-success">Submit</button>     
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Number</th><th>Price</th><th>Operator</th>
                                        <th>ผลรวม</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($number as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->number }}</td><td>{{ $item->price }}</td><td>{{ $item->operator }}</td>
                                        <td>{{ $item->total }}</td>
                                        <td>
                                            <a href="{{ url('/number/' . $item->id) }}" title="View Number"><button class="btn btn-info btn-sm"><i class="fa fa-shopping-cart" aria-hidden="true"></i> สั่งซื้อ</button></a>
                                            
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
                            <div class="pagination-wrapper"> {!! $number->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


