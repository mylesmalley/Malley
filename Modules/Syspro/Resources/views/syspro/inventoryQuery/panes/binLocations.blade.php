<div id="binLocations" class="syspro-window ">
    <div class="syspro-window-menu">Bin Locations</div>
    <div class="syspro-window-content">
        <table>
            <thead>
            <tr>
                <th></th>
                <th>Warehouse</th>
                <th>Bin</th>
                <th>Quantity</th>
            </tr>
            </thead>
            @foreach( $binLocations as $bin )
                <tbody>

                <tr>
                    <td></td>
                    <td>{{ $bin->Warehouse }} </td>
                    <td>{{ $bin->Bin }} </td>
                    <td>{{ number_format( $bin->QtyOnHand1, 3) }} {{ $inv->StockUom ?? "N/A" }} </td>
                </tr>
                </tbody>

            @endforeach
        </table>

        <h4>Default Bin(s)</h4>
        <ul>
            @foreach ( $defaultBins as $bin )
                <li>{{ $bin->DefaultBin }}</li>
            @endforeach
        </ul>
    </div>
</div>
