<div class="row">
    <div class="col-8 offset-2">
        <div class="card border-primary">
            <div class="card-header text-white bg-secondary">
                <h4 class="">{{ $element->label }}</h4>
                {{ $show ? "show" : "hide" }}
            </div>
            <div class="card-body">

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
            </div>
        </div>
    </div>
</div>
