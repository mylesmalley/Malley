<div class="card border-primary ">
    <div class="card-header bg-primary text-white">Sales
        <a href="{{ url('/index/option/'.$option->id.'/pricing') }}"
           class='btn btn-sm btn-secondary float-end'>Edit</a>

    </div>
    <table class="table table-sm" >
        <tbody>
            <tr>
                <td>Live Cost</td>
                <td>$ {{ number_format( $option->totalCost(),2) }}</td>
            </tr>
            <tr>
                <td>Dealer Price</td>
                <td>$ {{ number_format($option->option_price_tier_2 - $option->option_price_dealer_offset, 2 ) }}</td>
            </tr>
            <tr>
                <td>MSRP Price</td>
                <td>$ {{ number_format($option->option_price_tier_3- $option->option_price_msrp_offset, 2 ) }}</td>
            </tr>
            <tr>
                <td>Shown on Quotes?</td>
                <td>{{ $option->option_show_on_quote ? "Yes" : "No" }}</td>
            </tr>
        </tbody>
    </table>
</div>
