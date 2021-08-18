<div id="whereUsed" class="syspro-window ">
    <div class="syspro-window-menu">Where Used</div>
    <div class="syspro-window-content">
        <table>
            <thead>
            <tr>
                <th>Stock Code</th>
                <th>Description</th>
                <th>Qty</th>
            </tr>
            </thead>
            <tbody>

            @forelse( $whereUsed as $s)
                <tr>
                    <td><a href="{{ url("/syspro/inventoryQuery/{$s->ParentPart}") }}">{{ $s->ParentPart }}</a></td>
                    <td>{{ $s->Description }}</td>
                    <td>{{ number_format( $s->QtyPer, 1 ) }}</td>

                </tr>
            @empty
                <tr>
                    <td colspan="3">Not used by any assemblies</td>
                </tr>
            @endforelse
            </tbody>

        </table>


    </div>
</div>
