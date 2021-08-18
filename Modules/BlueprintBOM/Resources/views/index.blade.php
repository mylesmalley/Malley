@extends('blueprintbom::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('blueprintbom.name') !!}
    </p>

    <div id="app">

    </div>
@endsection
