@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>{{ $form->name }}

                <a href="{{ url('/index/basevan/'.$basevan->id.'/forms') }}" class="btn float-right btn-dark btn-lg">Back To Forms</a>
            </h1>
            <h3 class="text-secondary">For {{ $basevan->name }}</h3>

        </div>
    </div>


    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header  bg-dark text-light">
                    New Form Blocks
                </div>
                @if ( $form->standard_blueprint_form )
                <div class="card-body">
                    <a href="{{ url('/index/forms/imageblock/create/'.$form->id ) }}"
                       class="btn btn-outline-success">Image Block</a>
                    <a href="{{ url('/index/forms/selection/create/'.$form->id ) }}"
                       class="btn btn-outline-info">Selection Block</a>
                    <a href="{{ url('/index/forms/checkbox/create/'.$form->id ) }}"
                       class="btn btn-outline-danger">Checkbox Block</a>
                    <a href="{{ url('/index/forms/labels/create/'.$form->id ) }}"
                       class="btn btn-outline-warning">Label</a>
                </div>
                @else
                    <div class="card-body">
                        <a href="{{ url('index/forms/imageblock/create/'.$form->id ) }}"
                           class="btn btn-outline-success">Quantities</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-3">
            <div class="card">
                <div class="card-header  bg-dark text-light">
                   Form Options
                </div>
                <div class="card-body">
                    <a href="{{ url('index/forms/'.$form->id.'/reorder' ) }}"
                       class="btn btn-outline-info">Re Order Form</a>
                    <a href="{{ url('index/forms/imageblock/create/'.$form->id ) }}"
                       class="btn btn-outline-warning">Edit Form</a>
                </div>
            </div>
        </div>
    </div>

    <br>

        @foreach( $form->elements as $element)
            <div class="row">
                @if ( $element->indent && $element->indent > 0)
                    <div class="col-{{ $element->indent }}"> </div>
                @endif
                <div class="col-{{ 12 - $element->indent }}">

                    @if ( $element->type === 'selection')
                        @includeIf('index::index.forms.elements.selection.show')
                    @endif
                        @if ( $element->type === 'label')
                            @includeIf('index::index.forms.elements.labels.show')
                        @endif
                        @if ( $element->type === 'checklist')
                            @includeIf('index::index.forms.elements.checkbox.show')
                        @endif
                    @if ( $element->type === 'quantity')
                            @includeIf('index::index.forms.elements.quantity.show')
                    @endif
                    @if ( $element->type === 'images')
                            @includeIf('index::index.forms.elements.images.show')

                    @endif

                </div>
            </div>
            <br />

        @endforeach




@endsection


