<thead>
    <tr>
        @if ( isset(  Auth::user()->index_show_id_column )
            && Auth::user()->index_show_id_column )
            <th>ID #</th>
        @endif

        <th> Name </th>
            <th> Rev </th>

        <th> Description </th>

        @if ( isset(  Auth::user()->index_show_obsolete_options )
            && Auth::user()->index_show_obsolete_options )
            <th> Obsolete </th>

        @endif

        @if ( isset(  Auth::user()->index_show_phantom_column )
            && Auth::user()->index_show_phantom_column )
            <th> Phantom </th>
        @endif

            @if ( isset(  Auth::user()->index_show_tags_column )
        && Auth::user()->index_show_tags_column )
                <th> Tags </th>
            @endif

            @if ( isset(  Auth::user()->index_show_errors_column )
        && Auth::user()->index_show_errors_column )
                <th> Errors </th>
            @endif

            @if ( isset(  Auth::user()->index_show_pricing_columns )
&& Auth::user()->index_show_pricing_columns )
                <th> Dealer Price </th>
                <th> MSRP </th>
            @endif



    </tr>
</thead>
