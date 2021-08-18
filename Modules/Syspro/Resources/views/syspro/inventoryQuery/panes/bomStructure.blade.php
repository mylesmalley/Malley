<div id="structure" class="syspro-window ">
    <div class="syspro-window-menu">BOM Structure</div>
    <div class="syspro-window-content">
        <table>
            <thead>
            <tr>
                <th>Stock Code</th>
                <th>Qty</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>

            @forelse( $structure as $s)
                <tr>
                    <td><a href="{{ url("/syspro/inventoryQuery/{$s->Component}") }}">{{ $s->Component }}</a></td>
                    <td>{{ number_format( $s->QtyPer, 1 ) }}</td>
                    <td>{{ $s->Description }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="3">No sub components</td>
                </tr>
            @endforelse
            </tbody>

        </table>


    </div>
</div>
