@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">MyLog {{ $mylog->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/my-log') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/my-log/' . $mylog->id . '/edit') }}" title="Edit MyLog"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('mylog' . '/' . $mylog->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete MyLog" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $mylog->id }}</td>
                                    </tr>
                                    <tr><th> Message </th><td> {{ $mylog->message }} </td></tr><tr><th> Code </th><td> {{ $mylog->code }} </td></tr><tr><th> File </th><td> {{ $mylog->file }} </td></tr><tr><th> Line </th><td> {{ $mylog->line }} </td></tr><tr><th> Content </th><td> {{ $mylog->content }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
