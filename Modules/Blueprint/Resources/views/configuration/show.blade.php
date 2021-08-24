@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Configuration</h3>
        </div>
    </div>

    @foreach( $configurations as $config )
        @livewire("blueprint::configuration-line", [ 'configuration' => $config ]  )
    @endforeach
@endsection