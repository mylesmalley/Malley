<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class TicketController extends Controller
{


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


        return $this->test( $tickets );
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



    public function test( Collection $data )
    {

        $data = $data->toArray();

        $pdf = new Fpdf('P', 'in', 'letter');
      //  $pdf->SetMargins(0,0.25,0);
        $pdf->SetFont('Courier', '', '12');
        $pdf->SetAutoPageBreak(false);
       // $pdf->AddPage();


        $pages = array_chunk( $data, 7 );

        foreach( $pages as $page )
        {
            $pdf->AddPage();
            for( $i = 0; $i < count($page); $i++)
            {
                // starting point of the ticket
                $pdf->SetXY( 0.25,1.5 * $i + 0.25 );
                $pdf->Cell(5.416,0.125, $page[$i]->stock_code,1);

                $pdf->SetX( 5.45 );
                $pdf->Cell(2.583,0.125, $page[$i]->stock_code,1);


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
