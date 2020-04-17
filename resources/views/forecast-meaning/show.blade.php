@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">ForecastMeaning {{ $forecastmeaning->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/forecast-meaning') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/forecast-meaning/' . $forecastmeaning->id . '/edit') }}" title="Edit ForecastMeaning"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('forecastmeaning' . '/' . $forecastmeaning->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ForecastMeaning" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $forecastmeaning->id }}</td>
                                    </tr>
                                    <tr><th> Number </th><td> {{ $forecastmeaning->number }} </td></tr><tr><th> Content </th><td> {{ $forecastmeaning->content }} </td></tr><tr><th> Position </th><td> {{ $forecastmeaning->position }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
