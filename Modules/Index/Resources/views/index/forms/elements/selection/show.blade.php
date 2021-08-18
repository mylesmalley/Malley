<div class="card">
    <div class="card-header">
        <h4>{{ $element->label }}

            <a href="{{ url('index/forms/selection/'.$element->id ) }}"
               class='btn btn-sm btn-outline-dark float-right'>Edit Selection</a>

        </h4>

        @if( $element->rule)

            Requires {{ $element->rule->operator }} of the following to be turned on to appear in Blueprint.
            <ul>
                @foreach( $element->rule->ruleOptions() as $opt )
                    <li>
                        <a class="text-danger" href="/index/option/{{$opt->id}}/home">
                            {{ $opt->option_name }} - {{ $opt->option_description }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
    <div class="card-body">
        <ul style="list-style-type: upper-alpha;">
            @foreach($element->items->sortBy('position') as $item)
                <li>
                    <a href="{{ url("/index/option/".$item->option->id)."/home" }}">
                        {{ $item->option->option_name }} - {{ $item->option->option_description }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
