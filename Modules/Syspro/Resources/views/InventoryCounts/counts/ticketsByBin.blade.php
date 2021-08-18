
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
            /*/   page-break-inside: avoid;*/
                /*padding: 0;*/
                padding: 0;
                margin: 0;
                height: 1.5in;

            }

            .body
            {
                border-top:1px solid black;
                box-sizing: border-box;
                width: 69%;
                float:left;
                margin: 0;
            }
            .stub
            {
                border-top:1px solid black;
                box-sizing: border-box;
                width:31%;
                float:right;
                margin: 0;
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

            .page {
                page-break-after: always;
                width: 100%;
                padding: 0;
                margin: 0;
            }


        </style>
    </head>
    <body>




    <div class="page">

    @foreach( $bins as $bin )
            <?php
            $lineCount = 0;
            ?>
        <?php
  //          $count = $items->where('bin', 'like',  "{$bin}%" )->count();
//            $itemsInBin = $items->where('bin', 'like',  "{$bin}%"  );

            /** @var TYPE_NAME $bin */
            /** @var TYPE_NAME $items */
            $count = $items->filter(function ($item) use ($bin) {
                    // replace stristr with your choice of matching function
                    return false !== stristr($item->bin, $bin);
                })->count();
            $itemsInBin = $items->filter(function ($item) use ($bin) {
                // replace stristr with your choice of matching function
                return false !== stristr($item->bin, $bin);
            });


            $padding = 7 - ( $count % 7 );
        ?>

        @foreach( $itemsInBin as $item )

                @include('syspro::InventoryCounts.counts.ticket_table_body_template')
            <?php $lineCount++ ?>
            @if ( $lineCount % 7 == 0)


                </div><div class="page">
                @endif
        @endforeach
        @for( $i = 0; $i < $padding; $i++ )
            @include('syspro::InventoryCounts.counts.ticket_blank_template')
            <?php $lineCount++ ?>
            @if ( $lineCount % 7 == 0)



                </div><div class="page">
        @endif
        @endfor

    @endforeach

    </div>

    </body>

</html>

