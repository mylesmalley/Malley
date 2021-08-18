asdf asd fasd fsda
<hr>

<table>


@forelse( $lines as $line )
    @if ( request('edit') == $line->id)
        <tr>
            <td>
                {{ $line->id }}
            </td>
            <td>

                <input type="text" name="part[]"
                        value="{{ $line->part_number }}">
            </td>
            <td>
                Save
            </td>
        </tr>
    @else
        <tr>
            <td>
                {{ $line->id }}
            </td>
            <td>{{ $line->part_number }}</td>
            <td>
                @if ( ! request('edit') )
                    Edit
                @endif
            </td>
        </tr>
    @endif
@empty
    empty

@endforelse
</table>
@if ( ! request('edit') )
    ADD
@endif

<script>


</script>
