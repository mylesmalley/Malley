<tr onclick="loacOption({{$option->id}})">
    @if ( isset(Auth::user()->index_show_id_column )
        && Auth::user()->index_show_id_column )
        <td>{{ $option->id }}</td>
    @endif
        <td>{{ $option->option_name }}</td>
        <td>{{ $option->revision }}</td>
    <td>{{ $option->option_description }}</td>
        @if ( isset(  Auth::user()->index_show_obsolete_options )
            && Auth::user()->index_show_obsolete_options )
            <td>{{ $option->obsolete ? "Yes" : "No" }}</td>

        @endif
        @if ( isset(  Auth::user()->index_show_phantom_column )
               && Auth::user()->index_show_phantom_column )
            <td
                {!!  (!$option->no_components && !$option->option_syspro_phantom ) ? "class='text-white bg-danger'" : '' !!}
            >{{ $option->option_syspro_phantom ?? "NO PHANTOM" }}</td>

        @endif

            @if ( isset(  Auth::user()->index_show_tags_column )
                && Auth::user()->index_show_tags_column )
                    <td>
                            @foreach( $option->tags as $tag )
                                    <span class="badge bg-dark">{{ $tag->name }}</span>
                                    @endforeach
                    </td>

            @endif


            @if ( isset(  Auth::user()->index_show_errors_column )
        && Auth::user()->index_show_errors_column )
                    <td>
                            <ul class="text-danger">
                                    @foreach( $option->errors() as $err )
                                            <li>{{ $err }}</li>
                                    @endforeach
                            </ul>
                    </td>

            @endif


        @if ( isset(  Auth::user()->index_show_pricing_columns )
&& Auth::user()->index_show_pricing_columns )
            <td style="text-align: right;">

                $ {{ number_format( $option->option_price_tier_2 - $option->option_price_dealer_offset, 2) }}
            </td>
            <td style="text-align: right;">
                $ {{ number_format( $option->option_price_tier_3 - $option->option_price_msrp_offset, 2) }}
            </td>
        @endif

{{--    <td>--}}
{{--        {{ $option->option_show_on_quote == true ? "show" : "" }}--}}
{{--    </td>--}}


</tr>
