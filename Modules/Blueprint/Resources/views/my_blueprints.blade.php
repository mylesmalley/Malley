@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $title  ?? "My Blueprints"}}</h1>
        </div>
    </div>

@endsection
