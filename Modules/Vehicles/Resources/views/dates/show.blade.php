@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
        Dates for  <a href="{{ url('vehicles/'.$vehicle->id) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">


    </div>


@endsection


