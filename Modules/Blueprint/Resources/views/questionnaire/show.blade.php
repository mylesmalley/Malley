@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $wizard->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->name ?? 'Van' }}</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-6 offset-3">
            @livewire("blueprint::question", ['blueprint'=>$blueprint, 'wizard'=>$wizard ]  )

        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6 offset-3">
            @livewire("blueprint::progress", ['blueprint'=>$blueprint,  'wizard'=>$wizard  ] )
        </div>
    </div>

    <br><br>
@endsection