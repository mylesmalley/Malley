@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $part->part_number }}</h1>
    @includeIf('app.components.errors')
    <ul>
    @foreach( $categories as $category )
            <li><a href="{{ route('bg.categories.show', [$category])}}">
                    {{ $category->name }}
                </a></li>
        @endforeach
    </ul>

@endsection