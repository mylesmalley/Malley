<?php
 $units = [
     "BAG" => "PER BAG",
     "BOT" => "BOTTLE",
     "BOX" => "PER BOX",
     "BX" => "PER BOX",
     "CS" => "CASE",
     "EA" => "EACH",
     "FBM" => "PER BOARD FOOT",
     "FT" => "PER FOOT",
     "GAL" => "PER GALLON",
     "KIT" => "PER KIT",
     "LF" => "PER LINEAR FOOT",
     "LT" => "PER LITER",
     "LYD" => "PER LINEAR YARD",
     "MR" => "PER METER",
     "PK" => "PER PACK",
     "PR" => "AS A PAIR",
     "ROL" => "PER ROLL",
     "QRT" => "PER QUART",
     "RL" => "PER ROLL",
     "SET" => "AS A SET",
     "SQF" => "PER SQUARE FOOT",
     "YD" => "PER YARD",
 ];

 $unitExploded = $units[ $item->unit_of_measure ] ?? "Each";
?>

<table style=" margin:0; padding:0;border-top:1px solid black;
                box-sizing: border-box; width: 100%; height:1.5in; ">
    <tr>
        <td style="width: 66%; ">
            <table style="width:5.25in;">
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
                        <small>
                            T# {{ $item->line_status !== "Needs Recount" ? str_pad($item->ticket_number, 4, "0", STR_PAD_LEFT) :str_pad($item->ticket_number, 4, "0", STR_PAD_LEFT). ' RECOUNT' }} -<b> {{ $inventory->description }}</b> </small>

                    </td>
                    <td align="right" valign="top"><br>
                        <small>BIN: {{ $item->bin }} WH: {{ $item->warehouse }} </small><br>
                        <small>Supplier #: {{ $item->catalogue ?? '' }} </small><br>
                        <small>Supplier: {{ $item->supplier ?? '' }} </small>
                        <br>
                        <br>
                        <div style="text-align: right;">
                            QTY:______<small>{{ $unitExploded }}

                            @if( $item->line_status === "Needs Recount"  )
                                 <br> Last Count: {{ number_format( $item->counted_quantity,2 ) }}
                                @endif
                            </small>
                        </div>
                    </td>

                </tr>
            </table>
        </td>
        <td style="width: 2.7in; ">
            &nbsp;&nbsp;
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
                            T# {{ $item->line_status !== "Needs Recount" ? str_pad($item->ticket_number, 4, "0", STR_PAD_LEFT) : str_pad($item->ticket_number, 4, "0", STR_PAD_LEFT). ' RECOUNT' }}
                        </small>

                    </td>
                    <td valign="top" align="right">

                        QTY:______{{ $item->unit_of_measure ?? 'EA' }}
                        <small>

                        @if( $item->line_status === "Needs Recount"  )
                            Last Count: {{ number_format( $item->counted_quantity, 2 ) }}
                        @endif

                        </small>

                    </td>

                </tr>
            </table>

        </td>
    </tr>
</table>
