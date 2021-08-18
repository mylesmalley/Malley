@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>Reorder {{ $form->name }}

                <a href="{{ url('/index/basevan/'.$form->base_van_id.'/forms/'.$form->id) }}"
                   class="btn float-right btn-dark btn-lg">Back To Forms</a>
            </h1>
            <h3 class="text-secondary">For {{ $form->basevan->name ?? 'platform name' }}</h3>

        </div>
    </div>


    @includeIf('app.components.errors')


    @foreach( $elements as $element )
        <div class='row'>
            @if ( $element->indent && $element->indent > 0)
                <div class="col-{{ $element->indent }}"> </div>
            @endif
            <div class="col-{{ 12 - $element->indent }}">
                <div class='card'>
                    <div class='card-header'>
                        <div class="row">
                            <div class="col-10">
                                {{ $element->label }} - {{ $element->type }}
                            </div>
                            <div class="col-2">
                                <form method="POST" action="{{ url('index/forms/
'.$element->form_id.'/reorder') }}" class="float-right">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <input type="hidden"
                                           name="form_element_id"
                                           id="form_element_id"
                                           value="{{ $element->id }}">
                                    <select aria-label=""
                                            onchange="this.form.submit()"
                                            id="position"
                                            name="position"
                                            class="'float-right">
                                        @for( $i = 0; $i <= $count +1; $i++ )
                                            <option
                                                    {{ $i == $element->position ? 'selected' : '' }}
                                            >{{ $i }}</option>
                                        @endfor
                                    </select>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
