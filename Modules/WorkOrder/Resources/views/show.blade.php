@extends('vehicles::layout')

@section('content')

    @includeIf('vehicles::errors')

    <h1>Work Order {{ $workOrder->number ?? $workOrder->id }} for <a href="{{ url("/vehicles/{$workOrder->vehicle->id}") }}">{{ $workOrder->vehicle->identifier }}</a></h1>

    <hr>
    @includeIf('workorder::sections.details')
    @if( $workOrder->vehicle->id !== 3086)
         @includeIf('workorder::sections.vehicle')
    @endif
    @includeIf('workorder::sections.customer')

    @includeIf('workorder::sections.lines')
    @includeIf('workorder::sections.formatting')


    <hr>

    <a href="{{ url("workOrders/{$workOrder->id}/render") }}" class="btn btn-lg btn-info">Show PDF</a>
@endsection
