@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="">{{ $inventory->description }}</h1>
    <h3 class="">{{ $title ?? "All Items" }}</h3>

    <br>
    <div class="row">

        <div class="col-md-12">

            <a href="{{ url('syspro/inventory/'.$inventory->id ) }}"
               class="btn btn-secondary">Back to Count Home</a>


        </div>

    </div>

    @includeIf('syspro::InventoryCounts.counts.search.itemsList', ['items'=> $items])

@endsection
