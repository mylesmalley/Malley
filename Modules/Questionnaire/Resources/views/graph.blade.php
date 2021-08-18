@extends('questionnaire::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('questionnaire.name') !!}
    </p>
{{--    @livewire('questionnaire::QuestionQuery')--}}

    <div class="row">
        <div class="col-9">
            @livewire("questionnaire::question-query", ['wizard_id' => $wizard->id ]  )

        </div>
        <div class="col-3">
            @livewire("questionnaire::new-question", ['wizard_id' => $wizard->id ] )

        </div>
    </div>

    <div class="mermaid">


        {{ $graph }}
    </div>

{{--    {{ $graph }}--}}

@endsection
