@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3"> "{{ $tag->name }}" Vehicles

            </h1>
        </div>
    </div>

    @includeIf('vehicles::errors')



    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th> Work Order </th>
            <th> Customer </th>
            <th> VIN </th>
            <th> Malley # </th>
            <th> Vehicle </th>
            <td></td>
        </tr>
        </thead>
        <tbody>
        @forelse( $results as $v )
            {{--                <tr onclick="window.location = '{{ url('/vehicles/'.$v->id) }}'; ">--}}
            <tr>
                <td> {{ $v->work_order }} </td>
                <td> {{ $v->customer_name }} </td>
                <td> {{ $v->vin }} </td>
                <td> {{ $v->malley_number }} </td>
                <td> {{ $v->make .' '.$v->model.' '.$v->year }} </td>
                <td>
                    <a href="{{ url('/vehicles/'.$v->id) }}" class="btn btn-sm btn-success">Go</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    No matches
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>



@endsection
