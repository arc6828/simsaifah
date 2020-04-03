@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bank</div>
                    <div class="card-body">
                        <a href="{{ url('/bank/create') }}" class="btn btn-success btn-sm" title="Add New Bank">
                            <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มบัญชี
                        </a>

                        <form method="GET" action="{{ url('/bank') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>ชื่อบัญชี</th>
                                        <th>เลขที่บัญชี</th>
                                        <th>ธนาคาร</th>
                                        <!--th>User Id</th>
                                        <th>Remark</th>
                                        <th>Status</th-->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bank as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->account_name }}</td>
                                        <td>{{ $item->account_number }}</td>
                                        <td>{{ $item->bank_name }}</td>
                                        <!--td>{{ $item->user_id }}</td>
                                        <td>{{ $item->remark }}</td>
                                        <td>{{ $item->status }}</td-->
                                        <td>
                                            <a href="{{ url('/bank/' . $item->id) }}" title="View Bank"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/bank/' . $item->id . '/edit') }}" title="Edit Bank"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/bank' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Bank" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $bank->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
