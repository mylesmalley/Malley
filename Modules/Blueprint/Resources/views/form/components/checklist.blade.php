<div>
    <h4 class="text-secondary">{{ $element->label }}</h4>

    <ul class="list-group list-group-flush">
        @foreach( $configurations as $index => $conf )
            <li
                wire:key="configuration-id-{{ $conf->id }}"
                class="list-group-item"
                wire:click="toggle({{ $index }})"
            >
                @if ( $conf->value )
                    <img src="{{ mix('img/checkmark.png') }}" height="14" width="14" alt="selected">
                @endif
                {{ $conf->option->option_description }}</li>
        @endforeach
    </ul>

    <hr>
</div>