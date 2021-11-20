@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }} Pricing Management
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')


    <div class="card border-primary">
        @includeIf('index::index.partials.tabs', ['selected' => 'pricing'])

        <div class="card-body">
            @foreach( $options as $option )
                @livewire("index::option-pricing", [ $option  ]  )
            @endforeach
        </div>

    </div>

@endsection
