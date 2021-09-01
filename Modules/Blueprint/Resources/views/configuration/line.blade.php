<tbody wire:key="config-key-{{ $configuration->id }}">

    <tr wire:click="details">
        <td>
            {{ $configuration->name }}
        </td>
        <td>
            {{ $configuration->description }}
        </td>
        @if ( $pricing )

            <td>{{ $configuration->quantity }}</td>
            <td class="text-end">{{ $configuration->price_tier_2 }}</td>
            <td class="text-end">{{ $configuration->price_tier_3 }}</td>

        @endif
    </tr>

    @if( $details )
        <tr>
            <td colspan="100">
                <div class="row">
                    <div class="col-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="configuration.value"
                                   wire:click="save"
                                   id="{{ $configuration->id }}value">
                            <label class="form-check-label"
                                   for="{{ $configuration->id }}value">Selected</label>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:click="save"
                                   wire:model="configuration.show_on_quote"
                                   id="{{ $configuration->id }}show_on_quote">
                            <label class="form-check-label"
                                   for="{{ $configuration->id }}show_on_quote">Show on Quote</label>
                        </div>
                    </div>

                </div>


{{--                @if ( $configuration->value )--}}
{{--                    <a wire:click="toggle"--}}
{{--                       class="btn btn-sm btn-danger">Turn Off</a>--}}
{{--                @else--}}
{{--                    <a wire:click="toggle"--}}
{{--                       class="btn btn-sm btn-success">Turn On</a>--}}
{{--                @endif--}}
            </td>
        </tr>
    @endif
</tbody>