<tr
    wire:key="{{ $configuration->id }}"
    class="{{ $configuration->value ? 'table-success' : '' }}">
    <td>
        {{ $configuration->name }}
    </td>
    <td>
        {{ $configuration->description }}
    </td>
    <td>
        <a class="btn btn-sm btn-info" wire:click="toggle">Toggle</a>
        {{ $configuration->value }}
    </td>
</tr>