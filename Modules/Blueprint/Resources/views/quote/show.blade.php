@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Quote</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>

    <div class="card border-primary">
        <div class="card-header bg-primary text-white text-center">
            {{ $title ?? "Configuration of Blueprint B-". $blueprint->id }}
        </div>
        <table class="table table-sm table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Dealer Price</th>
                <th>MSRP</th>
            </tr>
            </thead>

            @foreach( $configurations as $config )
                @livewire("blueprint::configuration-line", [ 'configuration' => $config, 'pricing' => true ]  )
            @endforeach
        </table>
    </div>

@endsection