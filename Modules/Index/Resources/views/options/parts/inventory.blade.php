<div class="card border-primary ">
    <div class="card-header bg-primary text-white">Inventory</div>
    @if ( !$option->no_components )
        <table class="table table-sm">
            <tbody>
            <tr>
                <td>Long Lead Time</td>
                <td>{{ $option->option_long_lead_time ? "Yes" : "No" }}</td>
            </tr>
            <tr>
                <td>Syspro Phantom</td>
                <td>{{ $option->option_syspro_phantom ?? "No phamtom set" }}</td>
            </tr>

            </tbody>
        </table>
    @else

        <div class="card-body">
            This option won't have components.
        </div>
    @endif
</div>
