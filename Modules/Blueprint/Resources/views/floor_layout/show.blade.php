@extends('blueprint::layouts.master')

@push('header_scripts')
    <script href="{{ mix('js/blueprint/floor_layout.js') }}"></script>
@endpush

@section('content')
    {{ mix('js/blueprint/floor_layout.js') }}
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Floor Layout</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>


@endsection