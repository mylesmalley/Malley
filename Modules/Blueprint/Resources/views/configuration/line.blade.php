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

                        <div class="form-group">
                            <label for="value">Turned on?</label>
                            <select name="value"
                                    wire:model="configuration.value"
                                    wire:change="save"
                                    class="form-control form-control-sm"
                                    id="value">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-2">

                        <div class="form-group">
                            <label for="show_on_quote">Show on Quote?</label>
                            <select name="show_on_quote"
                                    class="form-control form-control-sm"
                                    wire:model="configuration.show_on_quote"
                                    wire:change="save"
                                    id="show_on_quote">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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