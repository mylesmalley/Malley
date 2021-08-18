<div class="card">
    <div class="card-header">
        What's in Syspro {{ $option->option_syspro_phantom }}
    </div>
    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th>Stock Code</th>
            <th>Description</th>
            <th>QTY</th>
            <th>UOM</th>
        </tr>
        </thead>
        <tbody>

        @forelse( $syspro as $s )
            <tr>
                <td>{{ trim( $s->Component ) ?? "NA" }}</td>
                <td>{{ trim( $s->Description ) ?? "NA" }}</td>
                <td>{{ (float) $s->QtyPer ?? 0 }}</td>
                <td>{{ trim( $s->StockUom ) ?? 'EA' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    No components in Syspro
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>
    <small>These components are what is in Syspro right now.</small>
</div>
