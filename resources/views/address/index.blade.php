@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Address</div>
                    <div class="card-body">
                        <a href="{{ url('/address/create') }}" class="btn btn-success btn-sm" title="Add New Address">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{ url('/payment/create') }}" class="btn btn-success btn-sm" title="Add New Address">
                            <i class="fa fa-plus" aria-hidden="true"></i> แจ้งการชำระเงิน
                        </a>

                        <form method="GET" action="{{ url('/address') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Company</th>
                                        <th>Parish</th>
                                        <th>District</th>
                                        <th>Province</th>
                                        <th>Postal</th>
                                        <th>Contact</th>
                                        <th>Remake</th>
                                        <th class="d-none" >User Id</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($address as $item)
                                    <tr>
                                        <td class="d-none">{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->company }}</td>
                                        <td>{{ $item->parish }}</td>
                                        <td>{{ $item->district }}</td>
                                        <td>{{ $item->province }}</td>
                                        <td>{{ $item->postal }}</td>
                                        <td>{{ $item->contact }}</td>
                                        <td>{{ $item->remake }}</td>
                                        <td class="d-none">{{ $item->user_id }}</td>
                                        <td>
                                            <a href="{{ url('/address/' . $item->id) }}" title="View Address"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/address/' . $item->id . '/edit') }}" title="Edit Address"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/address' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $address->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
