<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Validation\Rules\In;

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









    public function tickets( Inventory $inventory, Request $request )
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


        return $this->test( $inventory, $tickets );
//        dd( $tickets );

//        return view('syspro::InventoryCounts.counts.tickets',[
//            'inventory' => $inventory,
//            'items' => $tickets
//        ]) ;


    }


    /**
     * @param Inventory $inventory
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ticketsByBin( Inventory $inventory, Request $request )
    {
        $bins = DB::table('Inventory_Latest_Counts')
            ->selectRaw('LEFT( bin, 3) AS bin')
            ->where('inventory_id', $inventory->id)
            ->whereIn('id', $request->id)
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
            ->whereIn('id', $request->id)
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


        //dd( $tickets );


    //    dd( $new );

        return view('syspro::InventoryCounts.counts.ticketsByBin',[
            'inventory' => $inventory,
            'bins' => $new, // trim out to only get the prefix
            'items' => $tickets,
        ]) ;


    }




    public function customTicketsForm(Inventory $inventory)
    {
        return view('syspro::InventoryCounts.counts.customTicketForm',[
            'inventory' => $inventory,
        ]);
    }

    public function customTickets( Inventory $inventory, Request $request )
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



        return view('syspro::InventoryCounts.counts.tickets',[
            'inventory' => $inventory,
            'items' => $tickets
        ]) ;


    }



    public function test(Inventory $inventory,  Collection $data )
    {

        $data = $data->toArray();

        $pdf = new Fpdf('P', 'in', 'letter');
      //  $pdf->SetMargins(0,0.25,0);
        $pdf->SetFont('Courier', '', 12);
        $pdf->SetAutoPageBreak(false);
       // $pdf->AddPage();



        $pages = array_chunk( $data, 7 );

        $body = (2.833 * 2);
        $stub = 2.833;


        $sticker_width = 2.83333;
        $sticker_height = 1.5;

        $sticker_padding = 0.05;




        $body_width = ( $sticker_width * 2 ) - $sticker_padding - .25;


        $count_description = $inventory->description;
        $count_description_length = $pdf->GetStringWidth( $count_description .' ' );





        foreach( $pages as $page )
        {
            $pdf->AddPage();
            for( $i = 0; $i < count($page); $i++)
            {
                $body_start_x = 0.25;
                $body_start_y = $sticker_height * $i + 0.25 + $sticker_padding ;







                // starting point of the ticket
                $pdf->SetXY( $body_start_x, $body_start_y );

                $pdf->SetDrawColor(255,0,0);
                // ticket sticker
                $pdf->Rect( 0,
                    $sticker_height * $i + 0.25,
                    $sticker_width * 2,
                    $sticker_height);

                $pdf->SetDrawColor(0,255,0);
                // stub sticker
                $pdf->Rect( $sticker_width * 2,
                    $sticker_height * $i + 0.25 ,
                    $sticker_width,
                    $sticker_height);

                $pdf->SetDrawColor(0,0,255);
                // ticket print area
                $pdf->Rect( 0.25,
                    $sticker_height * $i + 0.25 + $sticker_padding,
                    $body_width,
                    $sticker_height - ( 2 * $sticker_padding));

                // stub print area
                $pdf->Rect( $sticker_width * 2,
                    $sticker_height * $i + 0.25 + $sticker_padding,
                    $sticker_width - .25,
                    $sticker_height - ( 2 * $sticker_padding));






                $ticket_number_text =  $page[$i]->line_status !== "Needs Recount"
                    ? "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT)
                    : "#". str_pad($page[$i]->ticket_number, 4, "0", STR_PAD_LEFT). ' RECOUNT' ;

                $part_text = "PART: ". trim( $page[$i]->stock_code ) ?? 'STOCK CODE';
                $bin_text = trim( "BIN: ". $page[$i]->bin ?? 'BIN');

                $ticket_number_length = $pdf->GetStringWidth( $ticket_number_text . ' ' );
                $part_text_length = $pdf->GetStringWidth( $part_text . ' ' );
                $bin_text_length = $pdf->GetStringWidth( $bin_text . ' ' );

             //   $pdf->SetTextColor(255, 255, 255 );




                $pdf->SetFillColor(175,175,175);
                $pdf->Cell( $ticket_number_length ,0.25, $ticket_number_text ,1 );//, 0, '', true);
             //   $pdf->Ln();
                $pdf->SetFillColor(0,0,0);


               // $pdf->Cell($body - $bin_text_length - $ticket_number_length - 0.5,0.25, $part_text ,1, 0, 'C', true);
                $pdf->Cell($part_text_length,0.25, $part_text ,1 );
             //   $pdf->Ln();

                $pdf->SetFillColor(175,175,175);
                $pdf->Cell( $bin_text_length,0.25, $bin_text ,1, 2);
               // $pdf->Cell( $bin_text_length,0.25, $bin_text ,1, 2, '', true);



                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0, 0, 0 );
                $pdf->SetFont('Courier', '', 10 );
                $pdf->SetX(0.25);




                /*
                 * DESCRIPTION AND SUPPLIER DETAILS
                 */
                $description_text = "Desc: ";
                $description_text_length = $pdf->GetStringWidth( $description_text . '  ' );


                $pdf->Cell(3,0.18, "Desc: ",0, '');
                $pdf->SetX(0.25 + $description_text_length);

                $pdf->Cell(3,0.18, $page[$i]->description_1,0, 2, '');
                $pdf->Cell(3,0.18, $page[$i]->description_2,0, 2, '');
                $pdf->Ln();
                $pdf->SetX(0.25);
                $pdf->Cell(3,0.18, "Suplier: ",0, '');
                $pdf->SetX(0.25 + $description_text_length);

                $pdf->Cell(3,0.18, $page[$i]->supplier ?? '',0, 2, '');

                $pdf->Cell(3,0.18, $page[$i]->catalogue ?? '',0, 2, '');

                $pdf->SetX(0.25);


                $pdf->SetTextColor(125, 125, 125 );


                $pdf->SetXY(( $sticker_width * 2) - $sticker_padding - $count_description_length,
                    $body_start_y + $sticker_height - (2 * $sticker_padding ) - .18 );

                $pdf->Cell(3,0.18, $count_description,0, 2, '');










                $pdf->SetX(0.25);


                $pdf->SetXY( 3,1.5 * $i + 1.2 );
                $unitExploded = $this->units[ $page[$i]->unit_of_measure ] ?? "Each";

                $pdf->Cell(2,.4, "QTY________".$unitExploded);



//
//            $pdf->SetTextColor(255, 255, 255 );
//
//                $pdf->SetXY( 5.45 ,1.5 * $i + 0.25 );
//                $pdf->SetFillColor(0,0,0);
//                $pdf->Cell(2.583,0.25, $page[$i]->stock_code,1, 2, '', true);
//                $pdf->SetFillColor(175,175,175);
//                $pdf->Cell(2.583,0.25, "BIN ". $page[$i]->bin ?? 'BIN',1, 2, '', true);
//
//                $pdf->SetTextColor(0, 0, 0 );
//
//                $pdf->Cell(3,0.2, $page[$i]->description_1,0, 2, '');
//                $pdf->Cell(3,0.2, $page[$i]->description_2,0, 2, '');

            }
        }
//
//        for ( $i = 0; $i < count($data); $i++ )
//        {
//
//            $displacement = 6 - ( $i % 7 );
//
//            $pdf->SetXY( 0,1.5 * $displacement );
//            $pdf->Cell(5,0.125, $data[$i]->stock_code,1);
//
//            if ($i > 0 && $i % 7 === 0)
//            {
//                $pdf->AddPage();
//            }
//        }
//


        $pdf->Output();
        exit;
    }


}
