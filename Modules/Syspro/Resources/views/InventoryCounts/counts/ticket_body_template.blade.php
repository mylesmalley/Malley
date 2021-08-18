<div class="ticket">
    <div class="stub">
        <table style="width:100%;">
            <tr>
                <td colspan="2">
                    <strong style="background-color:black; color:white; padding:2px; font-size: 13pt;">PART: {{ $item->stock_code }}</strong> <br>

                    <strong style="background-color:darkgray; color:white;  border:1px solid gray;
                    font-size: 13pt;">BIN: {{ $item->bin }}</strong> <br>

                    {{ substr( $item->description_1, 0, 40) }} <br>
                </td>
            </tr>
            <tr>
                <td>
                    <small>{{ $inventory->description }} <br>
                        T# {{ $item->line_status !== "Needs Recount" ? $item->id : $item->id. ' RECOUNT' }}
                    </small>

                </td>
                <td valign="bottom" align="right">
                    <br>
                    QTY:______{{ $item->unit_of_measure ?? 'EA' }}
                </td>
            </tr>
        </table>
    </div>

</div>
<div class="body">
    <table style="width:100%;">
        <tr>
            <td style="background: black;color:white; width:13px;">
                <div class="rotate">
                    {{ $item->locale }}
                </div>
            </td>
            <td>
                <strong style="background-color:black; color:white; padding:2px; font-size: 13pt;">PART: {{ $item->stock_code }}</strong> <br>

                <strong style="background-color:darkgray; color:white;  border:1px solid gray;
                    font-size: 13pt;">BIN: {{ $item->bin }}</strong> <br>


                {{ substr( $item->description_1, 0, 100) }} <br>
                {{ substr( $item->description_2, 0, 100) }} <br><br>
                <small>{{ $inventory->description }} <br>
                    T# {{ $item->line_status !== "Needs Recount" ? $item->id : $item->id. ' RECOUNT' }}</small>

            </td>
            <td align="right" valign="bottom">
                <small>Part: {{ $item->stock_code }} </small> <br>
                <small>BIN: {{ $item->bin }} WH: {{ $item->warehouse }} </small>
                <br><br><br> <br>
                <br>
                <div style="text-align: right;">
                    QTY:______{{ $item->unit_of_measure ?? 'EA' }}

                </div>
            </td>

        </tr>
    </table>





</div>

