<?php

namespace Modules\Syspro\Http\Controllers\Syspro;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class InventoryQueryController extends Controller
{
	/**
	 * @param Request $request
	 * @return View
	 */
	public function search( Request $request ): View
	{
		$request->validate([
			'term' => "sometimes|min:3|string"
		]);

		$highlight = [];

		if ( $request->term )
		{
			$bind = "%".strtoupper( $request->term )."%";
			$term =  $request->term ;

			//$term = "%INVE%";

			$search = DB::connection('syspro')
				->table('InvMaster AS Inv')
				->select(["Inv.StockCode", "Inv.Description", "PS.SupCatalogueNum","Inv.LongDesc"])
                ->leftJoin('PorSupStkInfo AS PS', 'Inv.StockCode', '=','PS.StockCode')
                ->whereRaw("Inv.StockCode collate SQL_Latin1_General_CP1_CI_AS like ?", [$bind])
				->orWhereRaw("Inv.Description collate SQL_Latin1_General_CP1_CI_AS like ?", [$bind])
                ->orWhereRaw("Inv.LongDesc collate SQL_Latin1_General_CP1_CI_AS like ?",  [$bind])
                ->orWhereRaw("PS.SupCatalogueNum collate SQL_Latin1_General_CP1_CI_AS like ?",  [$bind])
				->get();

			$search =collect( $search );

			$highlight = $search->map(function( $value, $key) use ($term) {


				return collect([
					'Code' =>$value->StockCode ,
					'StockCode' => str_ireplace($term, "<span class='search-highlight'>{$term}</span>", $value->StockCode ),
					'Description' => str_ireplace($term, "<span class='search-highlight'>{$term}</span>", $value->Description ),
                    'LongDesc' => str_ireplace($term, "<span class='search-highlight'>{$term}</span>", $value->LongDesc ),
                    'SupCatalogueNum' => str_ireplace($term, "<span class='search-highlight'>{$term}</span>", $value->SupCatalogueNum ),
				]);
			});

		//	dd($search, $highlight );
		}


		return view('syspro::syspro.inventoryQuery.search', ['results' => $highlight, 'term' => $request->term ]);
	}



	/**
	 * takes the inputted stock code and redirects to the query page. Allows for bookmarking certain codes
	 *
	 * @param Request $request
	 * @param string|null $code
	 * @return RedirectResponse
	 */
	public function show( Request $request, string $code = null  ): RedirectResponse
	{
		$request->validate([
			'term' => "alpha-dash|nullable",
		]);

		// if no code provided, redirect to this one
		$query = $code ?? $request->term ?? "15-13200";

		return redirect( '/syspro/inventoryQuery/'. strtoupper( $query ) );
	}

	/**
	 * Actually query the db and process from here.
	 *
	 * @param string $query
	 * @return View
	 */
	public function get( string $query ): View
	{
		// grab the stock code from the inv master table for a quick sanity check
		$stockCode = DB::connection('syspro')
			->table('InvMaster AS Inv')
			->select(['Inv.StockCode','Inv.PartCategory','Inv.StockOnHold','PS.LastPricePaid'])
			->leftJoin('PorSupStkInfo AS PS', 'Inv.StockCode', '=','PS.StockCode')

			->where( 'Inv.StockCode', $query )
			->first();

	//	dd( $stockCode);

		// if the stock code isn't found, redirect to error page.
		if (! $stockCode  )
		{
			return view('syspro::syspro.inventoryQuery.notFound', ["message" => "message"]);
		}

		// determine if the stock code is bought in or not, which influences the next query
		$boughtin = ($stockCode->PartCategory === "B" && $stockCode->StockOnHold === " " && $stockCode->LastPricePaid) ? true : false;


		$inv = DB::connection('syspro')
			->table('InvMaster AS Inv')
	/*		->select([
				"Inv.StockCode",
				"Inv.Description",
				"Inv.StockOnHold",
				"Inv.LongDesc",
				"PS.Supplier",
				"AP.SupplierChName",
				"PS.LastPrcUom",
				"PS.LastPricePaid",
				"Inv.StockUom",
				"Inv.MaterialCost",
				"Inv.LabourCost",
				"AP.Currency",
				"IW.UnitCost",
				"IW.QtyOnOrder",
				"IW.QtyOnHand",
				"Inv.PriceCategory",
			])
	*/
			->leftJoin('PorSupStkInfo AS PS', 'Inv.StockCode', '=','PS.StockCode')
			->leftJoin('InvWarehouse AS IW', 'Inv.StockCode', '=','IW.StockCode')
			->leftJoin('ApSupplier AS AP', 'Inv.Supplier', '=','AP.Supplier')
			->where( 'Inv.StockCode', $query )
			->when( $boughtin, function( $in ){
				// if the part is bought in, make this comparison
				$in->whereRaw("PS.Supplier = Inv.Supplier");
			})
			->first();


		// convert the db results into a collection for easier processing
		$inv = collect( $inv ) ;
	//	dd( $inv );

//		if ( !$inv->count() ) dd( $stockCode);

		// remove all of the extra spaces Syspro appends to columns
		$trimmed = $inv->map(function ($item, $key) {
			return trim($item);
		});


		// ignore the last price paid if the stock and order uom's don't match
		$LastPricePaid = ( $trimmed->get('LastPrcUom') === $trimmed->get('StockUom') )
			? (float) $trimmed->get("LastPricePaid") : 0;

		// ignore the last cost entered if the stock and order uom's don't match
		$LastCostEntered = ( $trimmed->get('LastPrcUom') === $trimmed->get('StockUom') )
			? (float) $trimmed->get("LastPriceEntered") : 0;

		// add the material and labour costs from invMaster together
		$InvCost = (float) $trimmed->get("MaterialCost") + (float) $trimmed->get("LabourCost");

		// group the calculated and retrieved costs
		$Costs = [
			"CalcLastPricePaid" => $LastPricePaid,
			"CalcLastPriceEntered" => $LastCostEntered,
			"CalcInvMasterCost" => $InvCost,
			"CalcUnitCost" => (float) $trimmed->get("UnitCost"),
		];

		// gets the max of the costs
		$MaxCost = max( $Costs );

		// add the costs to the response
		$trimmed->put('MaxCost',  $MaxCost );
		// work out the margin to use based on the price category
		$margin = 0;
		switch ( $inv->get("PriceCategory"))
		{
			case "A":   // no tier set
				$margin = 0.0;
				break;
			case "B":  // made in parts
				$margin = 0.65;
				break;
			case "C":  // bought out parts
				$margin = 0.35;
				break;
			case "D": // pass-through parts
				$margin = 0.2;
				break;
			default: // anything missed
				$margin = 0.4;
		}

		$trimmed->put('MarginUsed',  $margin * 100 );


		// default values for calculating selling prices
		$distributorDiscountRate = 0.85;
		$exchangeRate = 1.27;
		$inverseExchange = 1 / $exchangeRate; // 1:1.32 USD to CAD becomes 1:0.787 CAD to USD

		// calculate the usd and cad sales price tiers
		$RetailSellPriceCAD = $MaxCost / ( 1 - $margin) ;
		$RetailSellPriceUSD = $RetailSellPriceCAD * $inverseExchange;
		$DistributorSellPriceCAD = $RetailSellPriceCAD * $distributorDiscountRate;
		$DistributorSellPriceUSD = $RetailSellPriceUSD * $distributorDiscountRate;

		// add everythign to the response
		$trimmed->put('RetailSellPriceCAD', $RetailSellPriceCAD );
		$trimmed->put('RetailSellPriceUSD', $RetailSellPriceUSD );
		$trimmed->put('DistributorSellPriceCAD', $DistributorSellPriceCAD );
		$trimmed->put('DistributorSellPriceUSD', $DistributorSellPriceUSD );

		// convert the collection to an object for cleaner use in the view
		$raw = $trimmed;
		$trimmed = (object) $trimmed->toArray() ;

        $defaultBins = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_DEFAULT_BIN( ? )" ) )
            ->select('*')
            ->setBindings([ $query ])
            ->get();

        $binLocations = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_BIN_LOCATIONS( ? )" ) )
            ->select('*')
            ->setBindings([ $query ])
            ->get();


        $structure = DB::connection('syspro')
            ->table('BomStructure')
            ->select("BomStructure.Component","BomStructure.QtyPer","InvMaster.Description")
            ->leftJoin("InvMaster", "BomStructure.Component", "=", "InvMaster.StockCode")
            ->where( "ParentPart", $query )
            ->get();




        $inactive_options = DB::table('inactive_options')
            ->where('innactive_option','like', substr($query, 0, -4).'%')
            ->pluck('innactive_option')
            ->toArray();

        $allParentPhantoms = DB::connection('syspro')
            ->table('BomStructure')
            ->select("BomStructure.ParentPart as part")
            ->where( "Component", $query )
            ->pluck('part');


        $trimedAllParentPhantoms = $allParentPhantoms->map(function ($item, $key) {
            return trim($item);
        });




   //    dd($query, $inactive_options, $trimedAllParentPhantoms);

        $whereUsed = DB::connection('syspro')
            ->table('BomStructure')
            ->select("BomStructure.ParentPart","BomStructure.QtyPer","InvMaster.Description")
            ->leftJoin("InvMaster", "BomStructure.ParentPart", "=", "InvMaster.StockCode")
            ->where( "Component", $query )
            ->whereNotIn('BomStructure.ParentPart', $inactive_options )

            ->get();

      //  dd( $structure );

        return view( 'syspro::syspro.inventoryQuery.inventoryQuery', [
			'inv' => $trimmed,
			'raw'=> $raw,
			'costs'=>$Costs,
			"query"=>$query,
            "structure" => $structure,
            'whereUsed' => $whereUsed,
            'defaultBins' => $defaultBins,
            'binLocations' => $binLocations,
		]);
	}

}
