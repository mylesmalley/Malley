    <div class="card
    @if( ! count($option->formElementItems ))
        border-danger
            @else
        border-primary
    @endif
">
        <div class="card-header
    @if( ! count($option->formElementItems ))
            bg-danger text-white
@else
           bg-primary text-white
@endif

">
            Uses on Blueprint Forms
        </div>
        <div class="card-body">
            @if ( count( $option->formElementItems) )
                <ul>

                @foreach( $option->formElementItems as $opt )
                    <li>
                        {{ $opt->formElement->label ?? $opt->formElement->type }} ({{ ucfirst( $opt->formElement->type) }}) on form
                        @if ( $opt->formElement->form )
                        <a href="{{ url('/index/basevan/'.$option->base_van_id.'/forms/'.  $opt->formElement->form->id ) }}"> {{ $opt->formElement->form->name }}</a>
                        @else
                            <b>DELETED FORM ({{  $opt->formElement->id }})</b>
                        @endif
                    </li>
                @endforeach
                </ul>
                    @else
                Not used on any forms.
            @endif

        </div>
    </div>
