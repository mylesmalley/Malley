<tbody
    wire:key="{{ $configuration->id }}"
    class="{{ $configuration->value ? 'table-success' : '' }}">
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
            <td>
                @if ( $configuration->value )
                    <a wire:click="toggle"
                       class="btn btn-sm btn-danger">Turn Off</a>
                @else
                    <a wire:click="toggle"
                       class="btn btn-sm btn-success">Turn On</a>
                @endif
            </td>
        </tr>
    @endif
</tbody>