@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Configuration</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header">

        </div>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $configurations as $config )
                    @livewire("blueprint::configuration-line", [ 'configuration' => $config ]  )
                @endforeach
            </tbody>
        </table>
    </div>

@endsection