@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Address {{ $address->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/address') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/address/' . $address->id . '/edit') }}" title="Edit Address"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('address' . '/' . $address->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Address" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $address->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $address->name }} </td></tr><tr><th> Address </th><td> {{ $address->address }} </td></tr><tr><th> Company </th><td> {{ $address->company }} </td></tr><tr><th> Parish </th><td> {{ $address->parish }} </td></tr><tr><th> District </th><td> {{ $address->district }} </td></tr><tr><th> Province </th><td> {{ $address->province }} </td></tr><tr><th> Postal </th><td> {{ $address->postal }} </td></tr><tr><th> Contact </th><td> {{ $address->contact }} </td></tr><tr><th> Remake </th><td> {{ $address->remake }} </td></tr><tr><th> User Id </th><td> {{ $address->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
