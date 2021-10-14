@extends('questionnaire::layouts.master')

@section('content')
    <h1>{{ $wizard->name }}</h1>

{{--    @livewire('questionnaire::QuestionQuery')--}}

    <div class="row">
        <div class="col-9">
            @livewire("questionnaire::question-query", ['wizard_id' => $wizard->id ]  )

        </div>
        <div class="col-3">
            @livewire("questionnaire::new-question", ['wizard_id' => $wizard->id ] )

        </div>
    </div>

    <div class="mermaid" style="overflow: auto;">


        {{ $graph }}
    </div>

{{--    {{ $graph }}--}}

@endsection
