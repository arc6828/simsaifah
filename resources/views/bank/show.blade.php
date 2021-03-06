@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Bank {{ $bank->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/bank') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/bank/' . $bank->id . '/edit') }}" title="Edit Bank"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('bank' . '/' . $bank->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Bank" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $bank->id }}</td>
                                    </tr>
                                    <tr><th> Account Name </th><td> {{ $bank->account_name }} </td></tr><tr><th> Account Number </th><td> {{ $bank->account_number }} </td></tr><tr><th> Bank Name </th><td> {{ $bank->bank_name }} </td></tr><tr><th> User Id </th><td> {{ $bank->user_id }} </td></tr><tr><th> Remark </th><td> {{ $bank->remark }} </td></tr><tr><th> Status </th><td> {{ $bank->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
