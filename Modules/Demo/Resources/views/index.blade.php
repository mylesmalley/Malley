@extends('demo::layouts.master')

@section('content')



{{--    <div class="mermaid">--}}
{{--        graph LR--}}
{{--        @foreach( App\Models\WizardQuestion::get() as $q )--}}
{{--                Q{{ $q->id}}["Q: {{ $q->text }}"]--}}
{{--                click Q{{ $q->id }} "http://www.github.com"--}}
{{--        @endforeach--}}
{{--        @foreach( App\Models\WizardAnswer::get() as $a )--}}
{{--            Q{{ $a->wizard_question_id }} -- {{ $a->text }} --> Q{{ $a->next }}--}}
{{--        @endforeach--}}

{{--    </div>--}}


@endsection

