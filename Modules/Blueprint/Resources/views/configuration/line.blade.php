<tbody>

    <tr wire:click="details">
        <td>
            {{ $configuration->name }}
        </td>
        <td>
            {{ $configuration->description }}

            <span class="float-end">

            @if ($configuration->option
                    && Auth::user()->is_malley_staff
                    && !$configuration->option->componentCount
                    && !$configuration->option->no_components )
                <span class="badge bg-danger">NOT CONFIGURED</span>
            @endif
            @if (  !$configuration->show_on_quote )
                <span class="badge bg-dark">HIDDEN ON QUOTE</span>
            @endif
                        </span>

        </td>
        @if ( $pricing )

            <td class="text-end">{{ $configuration->quantity }}</td>
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

                    <div class="col-2">

                        <div class="form-group">
                            <label for="lock_pricing">Lock Pricing</label>
                            <select name="lock_pricing"
                                    class="form-control form-control-sm"
                                    wire:model="configuration.lock_pricing"
                                    wire:change="save"
                                    id="lock_pricing">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>


                    @if ( $configuration->option_id)
                    <div class="col-2">
                        <ul>
                            <li>
                                <a href="{{ route('option.home', [$configuration->option_id]) }}">Visit in the Index</a>
                            </li>
                            <li>
                                <a href="{{ route('option.usage', [$configuration->option_id]) }}">Option usage details</a>
                            </li>
                        </ul>
                        <small>Option Rev #: {{ $configuration->option->revision }}</small>
                    </div>
                    @else

                    @endif
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