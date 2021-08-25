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