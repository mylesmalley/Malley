@extends('vehicles::layout')

@section('content')


        <h1 class="text-center">
            {{ $title ?? 'No Title' }}&nbsp;

            <small class='text-muted'>{{ $descriptor ?? '' }}</small>
            <a href="{{ url('vehicles/create' ) }}"
               class='btn btn-success float-right'>Add New</a></h1>

    {!! $vehicles->links() !!}

    <div class="card border-primary">


    <table class='table table-striped  table-hover'>
        <thead class='thead-inverse '>
        	<th>Work Order</th>
        <th>VIN</th>
        <th><a href='{{ url(Request::path()."?srt=malley_number&ord=asc" ) }}'>Malley # &uarr;</a>
            <a style='' href='{{ url(Request::path()."?srt=malley_number&ord=desc" ) }}'>&nbsp;&darr;</a></th>
{{--        <th>Customer #</th>--}}
        <th>Description</th>
        <th>Dealer</th>
        <th>Customer</th>
        </thead>
        <tbody>
        @foreach ($vehicles as $vehicle)
            <tr onclick="window.location = '{{ url('/vehicles/'.$vehicle->id) }}'; ">
                 <td>{{ $vehicle->work_order ?? "" }}</td>
                <td>{{ $vehicle->vin ?? '' }}</td>
                <td>{{ $vehicle->malley_number ?? '' }}</td>
{{--                <td>{{ $vehicle->customer_number ?? '' }}</td>--}}
                <td>{{ $vehicle->make ?? '' }} {{ $vehicle->model ?? '' }} {{ $vehicle->year ?? '' }}</td>
                <td>{{ $vehicle->dealer->name ?? '' }}</td>
                <td>
                   {{ $vehicle->customer_name }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>
<div class="text-center">
    {!! $vehicles->links() !!}

</div>
@endsection
