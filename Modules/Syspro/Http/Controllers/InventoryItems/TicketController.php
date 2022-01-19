<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;

class TicketController extends Controller
{


    public array $units = [
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


    /**
     * @param Inventory $inventory
     * @param Request $request
     * @return void
     */
    #[NoReturn]
    public function tickets(Inventory $inventory, Request $request )
    {

        $tickets = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->whereIn('id', $request->id)
            ->whereNotIn('line_status',['Matched','Accepted'])
            ->orderBy('group')
            ->orderBy('bin')
            ->orderBy('stock_code')
            ->get();

        $stockCodes = $tickets->pluck('stock_code');

        $catNums = DB::connection('syspro')
            ->table('PorSupStkInfo')
            ->select('Supplier','StockCode','SupCatalogueNum')
            ->whereIn('StockCode', $stockCodes)
            ->get();


        foreach( $catNums as $sto )
        {

            $update = $tickets->where('stock_code', $sto->StockCode)
                ->where('supplier', $sto->Supplier);

            foreach( $update as $u )
            {
                $u->catalogue = $sto->SupCatalogueNum;
            }
        }


        return $this->tickets_by_bin( $inventory, $tickets );


    }


    /**
     * @param Inventory $inventory
     * @param Request $request
     * @return Application|Factory|View
     */
    #[NoReturn]
    public function ticketsByBin(Inventory $inventory, Request $request ): Factory|View|Application
    {
        $bins = DB::table('Inventory_Latest_Counts')
            ->selectRaw('LEFT( bin, 3) AS bin')
            ->where('inventory_id', $inventory->id)
            ->whereIn('id', $request->input('id'))
            ->groupBy('bin')
            ->get()
            ->toArray();

        $new = [];

        foreach( $bins as $bin )
        {
            if (!in_array($bin->bin, $new ) )
            {
                $new[] = $bin->bin;
            }
        }




        $tickets = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->whereIn('id', $request->input('id') )
            ->whereNotIn('line_status',['Matched','Accepted'])
            ->orderBy('group')
            ->orderBy('bin')
            ->orderBy('stock_code')
            ->get();
   //     dd( $tickets );


        $stockCodes = $tickets->pluck('stock_code');

       $catNums = DB::connection('syspro')
            ->table('PorSupStkInfo')
            ->select('Supplier','StockCode','SupCatalogueNum')
            ->whereIn('StockCode', $stockCodes)
            ->get();


       foreach( $catNums as $sto )
        {

            $update = $tickets->where('stock_code', $sto->StockCode)
                ->where('supplier', $sto->Supplier);

            foreach( $update as $u )
            {
                $u->catalogue = $sto->SupCatalogueNum;
            }
        }
        return $this->tickets_by_bin( $inventory, $tickets , true );

    }


    /**
     * @param Inventory $inventory
     * @return Response
     */
    public function customTicketsForm(Inventory $inventory): Response
    {
        return response()->view('syspro::InventoryCounts.counts.customTicketForm',[
            'inventory' => $inventory,
        ]);
    }


    /**
     * @param Inventory $inventory
     * @param Request $request
     */
    #[NoReturn]
    public function customTickets(Inventory $inventory, Request $request )
    {

        $rawIds =  preg_split('/\r\n|[\r\n]|,| /', $request->ids) ;

        $parsed = [];
        foreach( $rawIds as $rid)
        {
            if ( is_numeric($rid))
            {
                $parsed[] = $rid;
            }
        }
        $parsed = array_unique( $parsed );


        $tickets = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->whereIn('id', $parsed)
            ->orWhereIn('stock_code', $parsed)
      //      ->whereNotIn('line_status',['Matched','Accepted'])
            ->orderBy('group')
            ->orderBy('bin')
            ->orderBy('stock_code')
            ->get();

        $stockCodes = $tickets->pluck('stock_code');

        $catNums = DB::connection('syspro')
            ->table('PorSupStkInfo')
            ->select('Supplier','StockCode','SupCatalogueNum')
            ->whereIn('StockCode', $stockCodes)
            ->get();


        foreach( $catNums as $sto )
        {

            $update = $tickets->where('stock_code', $sto->StockCode)
                ->where('supplier', $sto->Supplier);

            foreach( $update as $u )
            {
                $u->catalogue = $sto->SupCatalogueNum;
            }
        }

        return $this->tickets_by_bin( $inventory, $tickets );


    }


    /**
     * @param Inventory $inventory
     * @param Collection $data
     * @param bool $group_by_bins
     */
    #[NoReturn]
    public function tickets_by_bin(Inventory $inventory, Collection $data, bool $group_by_bins = false )
    {
        $SHOW_BORDERS = 0;

        // pull in the name of the supplier to replace the vague supplier code.
        $suppliers = DB::connection('syspro')
            ->table('ApSupplier')
            ->pluck('SupplierName','Supplier');;

        if ($group_by_bins)
        {
            // returns the first three characters of the bin location to group them
            $grouped = $data->groupBy(function ($item) {
                return substr($item->bin,0, 3);
            });

            $current_bin = $grouped->keys()->first();
        }

        $pdf = new Fpdf('P', 'in', 'Letter');
        $pdf->SetFont('Courier', '', 12);
        $pdf->SetTopMargin(0.25);
        $pdf->SetAutoPageBreak(true, 0.25);

        $pdf->AddPage();



        // iterate through each ticket
        foreach( $data  as $d )
        {

            // if the $group_by_bins is true, fill the empty parts of pages with blank ticekts
            if ( $group_by_bins && substr($d->bin,0, 3) !== $current_bin )
            {
                $blank_count = 7 - $grouped->get($current_bin)->count() % 7;

                for( $i = 0; $i < $blank_count; $i++ )
                {
                    $pdf->SetFont('Courier', '', 12);
                    $pdf->SetX(0.25);

                    $pdf->SetFillColor(225,225,225);
                    $pdf->Cell( (2.8333 * 2)-.3 ,0.3, "NEW TICKET " ,0, 0, '', true);

                    $pdf->SetX( 2*2.8333);
                    $pdf->Cell( 2.5333 ,0.3, "NEW" ,0, 2, '', true);


                    $blank_body = [
                        "Bin location: ",
                        " ",
                        "Description:  ",
                        "              ",
                        "Supplier:  ",
                        "",
                    ];
                    $blank_count_section = [
                        "$inventory->description",
                        "",
                        "PART___________",
                        "",
                        "QTY:________",
                        "",
                    ];

                    $blank_stub_lines = [
                        "Bin: __________: ",
                        "",
                        "PART: ___________",
                        "",
                        "QTY: __________",
                        "",
                    ];

                    $pdf->SetFont('Courier', '', 10);

                    for($j = 0;  $j < 6; $j++)
                    {
                        $pdf->SetX(0.25);
                        $pdf->Cell(3.75, .2, $blank_body[$j], $SHOW_BORDERS);
                        $pdf->Cell(1.67, .2, $blank_count_section[$j], $SHOW_BORDERS, 0, 'C' );
                        $pdf->SetX(2.8333*2);
                        $pdf->Cell(2.8333, .2, $blank_stub_lines[$j], $SHOW_BORDERS, 2, 'C' );

                    }
                }

                // update the current bin to the next one
                $current_bin = substr($d->bin,0, 3);
                $pdf->AddPage();
            }


            $is_recount = $d->line_status === "Needs Recount";

            // build up ticket header
            $header = "";

            $ticket_number_text =  ($is_recount)
                ?  "#".str_pad($d->ticket_number,4,'0', STR_PAD_LEFT)."R"
                :  "#".str_pad($d->ticket_number,4,'0', STR_PAD_LEFT) ;

            $header .= str_pad($ticket_number_text, 8, ' ');
            $header .= str_pad( "AREA: ". $d->group. " BIN: ". $d->bin, 30);
            $header .= $d->stock_code;

            // Ticket header
            $pdf->SetX( 0.25);
            $pdf->SetFont('Courier', '', 12);
            $pdf->SetFillColor(225,225,225);
            $pdf->Cell( (2.8333 *2)-.3 ,0.3, $header ,0, 0, '', true);


            // STUB HEADER
            $pdf->SetX( 2*2.8333);
            $bin_stub_length = $pdf->GetStringWidth( $d->bin );
            $pdf->Cell( 2.8333 - 0.25 - $bin_stub_length ,0.3, $d->stock_code ,0, 0, '', true);
            $pdf->Cell( $bin_stub_length,0.3, $d->bin ,0, 2, 'R', true);




            $pdf->SetX( 0.25);
            $cat = isset( $d->catalogue) ? "Supplier# ".  $d->catalogue : '';

            $supplierName = $suppliers[$d->supplier] ?? 'not-set';

            $lines = [
                "Description: $d->description_1 ",
                "             $d->description_2 ",
                "              ",
                "Supplier: $supplierName ",
                "          $cat ", "",
            ];
            $unitExploded = $this->units[ trim( $d->unit_of_measure ) ] ?? "Each";

            $count = [
                "$inventory->description",
                ($is_recount) ? "Counted: ". $d->counted_quantity : "",
                "",
                "QTY:________",
                $unitExploded,
                "",
            ];


            $stub_lines = [
                $d->description_1,
                $d->description_2,
                    "",
                "QTY:________$d->unit_of_measure",
                "$ticket_number_text   $inventory->description",
                "",
            ];

            $pdf->SetFont('Courier', '', 10);

            for($i = 0;  $i < 6; $i++)
            {
                $pdf->SetX(0.25);
                $pdf->Cell(3.75, .2, $lines[$i], $SHOW_BORDERS);
                $pdf->Cell(1.67, .2, $count[$i], $SHOW_BORDERS, 0, 'C' );
                $pdf->SetX(2.8333*2);
                $pdf->Cell(2.8333, .2, $stub_lines[$i], $SHOW_BORDERS, 2, 'C' );

            }

        }

        $pdf->Output();
        exit;
    }

























//
//
//    /**
//     * @param Inventory $inventory
//     * @param Collection $data
//     * @param bool $bins
//     */
//    #[NoReturn]
//    public function test(Inventory $inventory, Collection $data, bool $bins = false )
//    {
//
//
//
//
//        $suppliers = DB::connection('syspro')
//            ->table('ApSupplier')
//            ->pluck('SupplierName','Supplier');;
//
//
//
////
////
////        $grouped = $data->groupBy(function ($item, $key) {
////            return substr($item->bin,0, 3);
////        });
////
////        //  $grouped->all();
////
////        dd( $grouped->all() );
////
//
//
//        $data = $data->toArray();
//        $pages = array_chunk( $data, 7 );
//
//
//
//        $pdf = new Fpdf('P', 'in', 'Letter');
//      //  $pdf->SetMargins(0,0.25,0);
//        $pdf->SetFont('Courier', '', 12);
//        $pdf->SetAutoPageBreak(false);
//       // $pdf->AddPage();
//
//
//
////        $body = (2.833 * 2);
////        $stub = 2.833;
////
//
//
//
//        $bin_name = $pages[0][0]->bin; // first bin from first page.
////        dd( $bin_name );
//
//        foreach( $pages as $page )
//        {
//            $pdf->AddPage();
//            for( $i = 0; $i < count($page); $i++)
//            {
//
//                $sticker_width = 2.83333;
//                $sticker_height = 1.5;
//                $sticker_padding = 0.05;
//                $body_width = ( $sticker_width * 2 ) - $sticker_padding - .25;
//
//                $count_description = $inventory->description;
//                $count_description_length = $pdf->GetStringWidth( $count_description .' ' );
//
//
//
//                $body_start_x = 0.25;
//                $body_start_y = $sticker_height * $i + 0.25 + $sticker_padding ;
//
//                $stub_start_x = $sticker_width * 2;
//
//                // starting point of the ticket
//                $pdf->SetXY( $body_start_x, $body_start_y );
//
////
//                $pdf->SetDrawColor(0,0,0);
////                // ticket sticker
////                $pdf->Rect( 0,
////                    $sticker_height * $i + 0.25,
////                    $sticker_width * 2,
////                    $sticker_height);
////
////                $pdf->SetDrawColor(0,255,0);
////                // stub sticker
////                $pdf->Rect( $sticker_width * 2,
////                    $sticker_height * $i + 0.25 ,
////                    $sticker_width,
////                    $sticker_height);
////
////                $pdf->SetDrawColor(0,0,255);
////                // ticket print area
//                $pdf->Rect( 0.25,
//                    $sticker_height * $i + 0.25 + $sticker_padding,
//                    $body_width,
//                    $sticker_height - ( 2 * $sticker_padding));
////
////                // stub print area
//                $pdf->Rect( $sticker_width * 2,
//                    $sticker_height * $i + 0.25 + $sticker_padding,
//                    $sticker_width - .25,
//                    $sticker_height - ( 2 * $sticker_padding));
//
//
//
//
//
//
//                $pdf->SetFont('Courier','B',12 );
//
//                $ticket_number_text =  $page[$i]->line_status !== "Needs Recount"
//                    ? "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT)
//                    : "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT). 'R' ;
//
//                $part_text = "PART: ". trim( $page[$i]->stock_code ) ?? 'STOCK CODE';
//                $bin_text = trim( "AREA: ". $page[$i]->group. " BIN: ". $page[$i]->bin ?? 'BIN');
//
//                $ticket_number_length = $pdf->GetStringWidth( $ticket_number_text . ' ' );
//                //$part_text_length = $pdf->GetStringWidth( $part_text . ' ' );
//                $bin_text_length = $pdf->GetStringWidth( $bin_text . ' ' );
//
//             //   $pdf->SetTextColor(255, 255, 255 );
//
//
//
//
//                $pdf->SetFillColor(225,225,225);
//               // $pdf->SetTextColor(0, 0, 0);
//                $pdf->Cell( $ticket_number_length ,0.25, $ticket_number_text ,0, 0, '', true);
//                // $pdf->SetTextColor(0, 0, 0);
//                $pdf->Cell( $bin_text_length,0.25, $bin_text ,0, 0, '', true);
//
//
//              //  $pdf->SetTextColor(255, 255, 255);
//                $pdf->Cell($body_width -$bin_text_length - $ticket_number_length ,0.25, $part_text ,0, 2, 'C', true  );
//
//
//
//
//                $pdf->SetFont('Courier','',12 );
//
//                // RESET COLOURS
//                $pdf->SetFillColor(255,255,255);
//              //  $pdf->SetTextColor(0, 0, 0 );
//                $pdf->SetFont('Courier', '', 10 );
//                $pdf->SetX(0.25);
//
//
//
//
//                /*
//                 * DESCRIPTION AND SUPPLIER DETAILS
//                 */
//                $description_text = "Desc:   ";
//                $description_text_length = $pdf->GetStringWidth( $description_text . '  ' );
//
//
//                $pdf->Cell(3,0.18, "Desc: ");
//                $pdf->SetX(0.25 + $description_text_length);
//
//                $pdf->Cell(3,0.18, $page[$i]->description_1,0, 2);
//                $pdf->Cell(3,0.18, $page[$i]->description_2,0, 2);
//                $pdf->Ln();
//                $pdf->SetX(0.25);
//                $pdf->Cell(3,0.18, "Supplier: ",0, '');
//                $pdf->SetX(0.25 + $description_text_length);
//
//                $pdf->Cell(3,0.18, $suppliers[$page[$i]->supplier] ?? '',0, 2);
//
//                $cat = isset( $page[$i]->catalogue) ? "Supplier# ".  $page[$i]->catalogue : '';
//
//                $pdf->Cell(3,0.18, $cat ,0, 2);
//
//                $pdf->SetX(0.25);
//
//
//               // $pdf->SetTextColor(125, 125, 125 );
//
//
//                $pdf->SetXY(( $sticker_width * 2) - $sticker_padding - $count_description_length,
//                    $body_start_y + $sticker_height - (2 * $sticker_padding ) - .18 );
//
//                $pdf->Cell(3,0.18, $count_description,0, 2);
//
//
//
//
//
//
//
//
//
//
//                $pdf->SetX(0.25);
//
//
//                $pdf->SetXY( 4,1.5 * $i + 1.2 );
//                $unitExploded = $this->units[ $page[$i]->unit_of_measure ] ?? "Each";
//
//                $pdf->Cell(2,.4, "QTY________".$unitExploded);
//
//
//
//
//
//
//
//
//                /*
//                 *  STUB STUB STUB STUB STUB
//                 */
//
//
//
//                $pdf->SetXY( $stub_start_x, $body_start_y );
//
//
//
//
//
//
//                $pdf->SetFillColor(225,225,225);
//                $pdf->SetFont('Courier','B',12 );
//
//                $ticket_number_text =  $page[$i]->line_status !== "Needs Recount"
//                    ? "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT)
//                    : "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT). 'R' ;
//
//                $part_text = trim( $page[$i]->stock_code ) ?? 'STOCK CODE';
//                $bin_text = trim( "BIN: ". $page[$i]->bin ?? 'BIN');
//
//           //     $ticket_number_length = $pdf->GetStringWidth( $ticket_number_text . ' ' );
//          //      $part_text_length = $pdf->GetStringWidth( $part_text . ' ' );
//                $bin_text_length = $pdf->GetStringWidth( $bin_text . ' ' );
//
//
//
//
//
////                $pdf->Cell( $ticket_number_length ,0.25, $ticket_number_text ,1 );//, 0, '', true);
//                //   $pdf->Ln();
//                $pdf->SetFillColor(225,225,225);
//            //    $pdf->SetTextColor(255, 255, 255);
//
//                // $pdf->Cell($body - $bin_text_length - $ticket_number_length - 0.5,0.25, $part_text ,1, 0, 'C', true);
//                $pdf->Cell($sticker_width - 0.25 - $bin_text_length ,0.25, $part_text ,0, 0, '', true );
//                //   $pdf->Ln();
//
//                $pdf->SetFillColor(225,225,225);
//           //     $pdf->SetTextColor(0,0,0);
//                $pdf->Cell( $bin_text_length,0.25, $bin_text ,0, 2, '', true);
//
//
//
//
//                $pdf->SetFont('Courier', '', 10 );
//
//
//                $pdf->SetFillColor(255,255,255);
//           //     $pdf->SetTextColor(0,0,0);
//
//
//                $pdf->SetX( $stub_start_x );
//
//                $pdf->Cell(3,0.18, $page[$i]->description_1,0, 2);
//                $pdf->Cell(3,0.18, $page[$i]->description_2,0, 2);
//
//                $pdf->Ln();
//                $pdf->Ln();
//                $pdf->SetX( $stub_start_x );
//
//                $pdf->Cell(2,.18, $ticket_number_text."       QTY________".$page[$i]->unit_of_measure, 0, 2);
//                $pdf->SetX( $stub_start_x );
//
//                $pdf->Cell(2,.18, $count_description);
//
//
//
//                $pdf->SetFillColor(255,255,255);
//              //  $pdf->SetTextColor(0, 0, 0 );
//                $pdf->SetFont('Courier', '', 10 );
//
//
//
//
//
//
////
////            $pdf->SetTextColor(255, 255, 255 );
////
////                $pdf->SetXY( 5.45 ,1.5 * $i + 0.25 );
////                $pdf->SetFillColor(0,0,0);
////                $pdf->Cell(2.583,0.25, $page[$i]->stock_code,1, 2, '', true);
////                $pdf->SetFillColor(175,175,175);
////                $pdf->Cell(2.583,0.25, "BIN ". $page[$i]->bin ?? 'BIN',1, 2, '', true);
////
////                $pdf->SetTextColor(0, 0, 0 );
////
////                $pdf->Cell(3,0.2, $page[$i]->description_1,0, 2, '');
////                $pdf->Cell(3,0.2, $page[$i]->description_2,0, 2, '');
//
//            }
//        }
////
////        for ( $i = 0; $i < count($data); $i++ )
////        {
////
////            $displacement = 6 - ( $i % 7 );
////
////            $pdf->SetXY( 0,1.5 * $displacement );
////            $pdf->Cell(5,0.125, $data[$i]->stock_code,1);
////
////            if ($i > 0 && $i % 7 === 0)
////            {
////                $pdf->AddPage();
////            }
////        }
////
//
//
//        $pdf->Output();
//        exit;
//    }


}
