<div class="card">
    <div class="card-header">
        <h4>{{ $element->label }}

            <a href="{{ url('index/forms/checkbox/'.$element->id ) }}"
               class='btn btn-sm btn-outline-dark float-right'>Edit Checkboxes</a>

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
        <ul style="list-style-type: none;">
            @foreach($element->items->sortBy('position') as $item)
{{--                @if( $item->option )--}}
                <li> YES / NO -
                    <a href="{{ url("/index/option/".$item->option->id)."/home" }}">
                        {{ $item->option->option_name }} - {{ $item->option->option_description }}
                    </a>
                </li>
{{--                @endif--}}
            @endforeach
        </ul>
    </div>
</div>
