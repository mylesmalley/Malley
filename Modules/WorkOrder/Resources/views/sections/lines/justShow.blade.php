<tr>
    <td>
        @if( $line->quantity)
            {{ number_format( $line->quantity, 1) }}
            @endif

    </td>
    <td>{{ $line->part_number }}</td>
    <td>{{ $line->description }}</td>
    <td></td>
</tr>
