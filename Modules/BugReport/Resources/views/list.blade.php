@extends('bugreport::template')

@section('content')
    <h1>{{ $title ?? "Title of Report" }}</h1>

    @foreach( $bugs as $bug )
        @include('bugreport::partials.bugView', ['bug' => $bug ])
    @endforeach

    {{ $bugs->links() }}

@endsection
