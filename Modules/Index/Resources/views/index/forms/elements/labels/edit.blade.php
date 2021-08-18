@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1> {{ $element->label }} Label )
                <a href="{{ url('/index/basevan/'.$basevan->id.'/forms/'.$form->id) }}" class="btn float-right btn-dark btn-lg">Back to {{ $form->name  }}</a>

            </h1>
            <h3 class="text-secondary">{{ $form->name }} Form</h3>
            <h3 class="text-secondary">{{ $basevan->name }}</h3>
        </div>
    </div>

    @includeIf('app.components.success')
    @includeIf('app.components.errors')

    @includeIf('index::index.forms.elements.shared.element_details_form',['target'=>'labels'])


@endsection


