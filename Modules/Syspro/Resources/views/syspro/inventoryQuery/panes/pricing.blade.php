<div id="distribution" class="syspro-window ">
    <div class="syspro-window-menu">Cost and Pricing</div>
    <div class="syspro-window-content">
        <table>
            <tr>
                <td>Unit of Measure</td>
                <td>{{ $inv->StockUom ?? "N/A" }}</td>
            </tr>

            <tr>
                <td>Cost</td>
                <td>$ {{ number_format(  $inv->MaxCost , 3 ) }} CAD</td>
            </tr>
            @if (isset( $inv->PriceCategory ))
                <tr>
                    <td>Price Category</td>
                    <td>{{ $inv->PriceCategory }} ( {{ $inv->MarginUsed }}% Margin )</td>
                </tr>
            @endif

            <tr>
                <td>Canadian Retail Price</td>
                <td>$ {{ number_format( $inv->RetailSellPriceCAD, 2) }} per {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>

            <tr>
                <td>USD Retail Price</td>
                <td>$ {{ number_format( $inv->RetailSellPriceUSD, 2) }} USD per {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>

            <tr>
                <td>Canadian Distributor Price</td>
                <td>$ {{ number_format( $inv->DistributorSellPriceCAD, 2) }} per {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>

            <tr>
                <td>USD Distributor Price</td>
                <td>$ {{ number_format( $inv->DistributorSellPriceUSD, 2) }} USD per {{ $inv->StockUom ?? "N/A" }}</td>
            </tr>


        </table>
    </div>
</div>
