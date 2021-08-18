<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>blah</title>
        <style>
            html, body {
                font-family: sans-serif;
            }
            table {
                border: 1px solid black;
                width: 100%;
            }
            th {
                text-align: left;
            }
            td {
                vertical-align: top;
            }
            .signoff
            {
                display: block;
                border-bottom: 1px solid black;
                padding-bottom: 2px;
                margin-top:5px;
            }
            .data {
                background: #dddddd;
                border-right: 1px solid black;
            }

            .body
            {
                border-collapse: collapse;
            }

            .body td, .body th
            {

                border: 1px solid black;
                padding:4px;
            }
        </style>
    </head>
    <body>

{{--        @if ( $workOrder->title === "WORK ORDER")--}}
{{--             @includeIf('workorder::render.header')--}}
{{--        @else--}}
            @includeIf('workorder::render.mobilityRepairOrderHeader')

{{--            @endif--}}
        <br>

        <div style="text-align: center;">REPAIR AS DIRECTED BELOW</div>
        @includeIf('workorder::render.lines')


{{--        @if ( $workOrder->title === "WORK ORDER")--}}

{{--            <table>--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th colspan="3">APPROVAL AND REVIEW </th>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th>APPROVAL</th>--}}
{{--                        <th>REVIEW</th>--}}
{{--                        <th>FINAL INSPECTION</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <table>--}}
{{--                                <tr >--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; SALES </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; PURCHASING </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; PLANNING </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; PRODUCTION </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; ENGINEERING </td>--}}
{{--                                </tr>--}}

{{--                            </table>--}}

{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <table>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; METALFAB--}}
{{--                                </td>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; ASSEMBLY </td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td style="border-bottom: 1px solid black">&#9744; ELECTRICAL </td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                                    <table>--}}

{{--                                            <tr>--}}
{{--                                        <td style="border-bottom: 1px solid black">DATE</td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td style="border-bottom: 1px solid black">SIGN</td>--}}
{{--                                    </tr>--}}
{{--                                    </table>--}}

{{--                        </td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}


{{--        @else--}}
            <br>
            <div style="text-align: center;">APPROVAL AND INSPECTION</div>
            <br>
            <table style="border:0; border:1px solid black;">
                <tr>
                    <td style="width:45%">
                        APPROVED BY <br><br>


                        SERVICE ________________________________ <br><br>

                    </td>
                    <td style="width:10%;
                                border: 2px solid black;
                                font-size: larger;
                                vertical-align: middle;
                                text-align: center;">
                        QC
                    </td>
                    <td style="width:45%">
                        FINAL INSPECTION AND SIGN OFF <br><br>
                        NAME ________________________________ <br><br>
                        DATE ________________________________ <br>
                    </td>
                </tr>
            </table>


{{--        @endif--}}





{{--        @if ( $workOrder->title === "WORK ORDER")--}}

{{--        @else--}}
            <div style="page-break-before: always;">

            <div style="text-align: center;">FOR INVOICING</div>
            <br>
                <table>
                    <tr>
                        <td style="width:20%">BILL TO:
                        </td>
                        <td>
                            <br>
                            &nbsp;

                            <br>
                            &nbsp;

                        </td>
                    </tr>

                </table>

                <br>


            <table>
                <tr>
                    <td>TOTAL HOURS</td>
                    <td>____________  x $95</td>
                </tr>
                <tr>
                    <td> SHOP SUPPLIES</td>
                    <td>$____________</td>
                </tr>
            </table>
                <br>
            <table>
                <tr>
                    <td>Parts / Material</td>
                    <td>Description</td>
                    <td>Qty</td>
                    <td>Price</td>

                    <td></td>
                </tr>
                @for( $i = 0; $i < 10; $i++ )
                    <tr>
                        <td>_________________</td>
                        <td>_____________________________________</td>
                        <td>_________________</td>
                        <td>$______________</td>
                        <td>Plus Tax </td>

                    </tr>
                    @endfor
            </table>
                Accounting, please see allocations in Syspro
                &nbsp; &nbsp;&#x2610; &nbsp; &nbsp;

            </div>

{{--        @endif--}}









    </body>
</html>

