@extends('labour::layouts.master')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 class="text-secondary text-center">Labour on Job</h4>
                <h1 class="text-center">{{ $job ?? "Pick a Job" }}</h1>
            </div>
        </div>
    </div>

@endsection
