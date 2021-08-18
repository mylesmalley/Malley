@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="">{{ $inventory->description }}</h1>
    <h3 class="">{{ ucwords( $filter . ' ' . $by ) }}</h3>

    <br>
<div class="row">

    <div class="col-md-12">

    <a href="{{ url('syspro/inventory/'.$inventory->id ) }}"
       class="btn btn-secondary">Back to Count Home</a>


    <a href="{{ url('syspro/inventory/'.$inventory->id.'/tickets?filter='.$filter .'&by='. $by ) }}"
       class="btn btn-primary">GENERATE TICKETS</a>
    </div>

</div>

    @includeIf('syspro::InventoryCounts.errors')

    <br>
    @includeIf('syspro::InventoryCounts.counts.search.itemsList', ['items'=> $items])


    <a href="{{ url('syspro/inventory/'. $inventory->id.'/items/create') }}"
       class="btn btn-success">New Item</a>
@endsection
