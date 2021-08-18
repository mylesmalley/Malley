
<html>
    <head>
        <style>

            html, body, table, tr, td
            {
                font-family: monospace ;
                /*color: orange;*/
                font-size: 11pt;

            }

            @page {
                margin:0.25in;
            }



            .ticket
            {
                /*margin:0;*/
                /*!*width:100%;*!*/
                /*!*display: blo;*!*/
                /*page-break-inside: avoid;*/
                /*padding: 0;*/
            }

            .body
            {
                border-top:1px solid black;
                box-sizing: border-box;
                width: 69%;
                height: 1.5in;
                float:left;
            }
            .stub
            {
                border-top:1px solid black;
                height: 1.5in;
                box-sizing: border-box;
                width:31%;
                float:right;
            }


            .rotate {

                background: black;
                color:white;
                padding:3px;

                /* FF3.5+ */
                -moz-transform: rotate(-90.0deg);
                /* Opera 10.5 */
                -o-transform: rotate(-90.0deg);
                /* Saf3.1+, Chrome */
                -webkit-transform: rotate(-90.0deg);
                /* IE6,IE7 */
                /*filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.083);*/
                /* IE8 */
                -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
                /* Standard */
                transform: rotate(-90.0deg);
            }


        </style>
    </head>
    <body>


    <?php
            $count = $items->count();
            $pad = 7 - ( $count & 7 );
        ?>

    @foreach( $items as $item )
        @include('syspro::InventoryCounts.counts.ticket_table_body_template')

    @endforeach

    @for( $i = 0; $i < $pad; $i++)
    @include('syspro::InventoryCounts.counts.ticket_blank_template')
@endfor


    </body>

</html>

