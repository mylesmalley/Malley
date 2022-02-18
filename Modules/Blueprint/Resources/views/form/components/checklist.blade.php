<div class="row">
    @if( $show )
    <div class="col-8 offset-2">
        <div class="card border-primary">
            <div class="card-header text-white bg-secondary">
                <h4 class="">{{ $element->label }} </h4>
                                {{ $show ? "show" : "hide" }}

            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    @foreach( $items as $item )
                        <li
                                wire:key="configuration-id-{{ $configuration[ $item->option_id ]['id'] }}"
                                class="list-group-item"
                                wire:click="toggle({{ $configuration[ $item->option_id ]['id'] }})"
                        >

                            @if ( $configuration[ $item->option_id ]['value'] )
                                <img src="{{ mix('img/checkmark.png') }}" height="14" width="14" alt="selected">
                            @endif

                            {{ $configuration[ $item->option_id ]['description'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
        @endif
</div>