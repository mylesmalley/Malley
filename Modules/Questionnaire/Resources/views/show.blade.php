@extends('questionnaire::layouts.master')

@section('content')
    <h1>{{ $wizard->name }}</h1>

{{--    @livewire('questionnaire::QuestionQuery')--}}

    <div class="row">
        <div class="col-6">
            @livewire("questionnaire::question", ['blueprint'=>$blueprint, 'wizard'=>$wizard ]  )

        </div>
        <div class="col-6">
            @livewire("questionnaire::progress", ['blueprint'=>$blueprint,  'wizard'=>$wizard  ] )

        </div>
    </div>



@endsection
