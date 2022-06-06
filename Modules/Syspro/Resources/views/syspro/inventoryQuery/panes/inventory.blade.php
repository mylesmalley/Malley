<div id="production" class="syspro-window ">
    <div class="syspro-window-menu">Inventory</div>
    <div class="syspro-window-content">
        <table>
            @if (isset($inv->QtyOnOrder))
                <tr>
                    <td>On Order</td>
                    <td>{{ number_format( $inv->QtyOnOrder,3) }} {{ $inv->StockUom ?? "N/A" }}</td>
                </tr>
            @endif

                @if (isset($inv->QtyOnHand))

                <tr>
                <td>On Hand</td>
                <td>{{  number_format( $inv->QtyOnHand, 3) }} {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>
                @endif

            <tr>
                <td>Units of Measure</td>
                <td>Stocked As {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Bought As {{ $inv->AlternateUom ?? "N/A"  }}</td>
            </tr>
                @if (isset($inv->Currency))

            <tr>
                <td>Bought In</td>
                <td>{{ $inv->Currency  }}</td>
            </tr>
                @endif

                @if (isset($inv->ConvFactAltUom))
            <tr>
                <td>Conversion</td>
                <td>1 {{ $inv->AlternateUom ?? "N/A"  }} = {{ number_format( $inv->ConvFactAltUom,2) ?? 'Err' }} {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>
                @endif

        </table>



    </div>
</div>
