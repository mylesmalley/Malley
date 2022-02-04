<table class="body">
    <thead>
        <tr>
            <th style="width:20%;">Part #</th>
            <th style="width:55%">Description</th>
{{--            <th>Purch</th>--}}
{{--            <th>Prod</th>--}}
            <th style="width:15%">Qty</th>

            <th style="width:10%; text-align: center;%">QC</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $workOrder->lines as $line )
            <tr>
                <td>{{ $line->part_number }}</td>
                <td>{{ $line->description }}</td>
                <td>
                    @if( $line->quantity)
                        {{ (float) number_format( $line->quantity, 1) }}
                    @endif

                </td>
                {{--                <td>&#9744;</td>--}}
{{--                <td>&#9744;</td>--}}
                <td style="text-align: center">&#x2610;</td>
            </tr>
        @endforeach
        @for( $i = 0; $i < $workOrder->linecount -$workOrder->lines->count(); $i++ )
            <tr>
                <td></td>
                <td></td>
                <td></td>
                {{--                <td>&#9744;</td>--}}
                {{--                <td>&#9744;</td>--}}
                <td style="text-align: center">&#x2610;</td>
            </tr>
        @endfor

    </tbody>
</table>


