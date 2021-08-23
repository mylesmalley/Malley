@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->platform->name ?? 'Van' }}</h3>
        </div>
    </div>



    @includeIf('blueprint::blueprint.home_components.about')






@endsection