<?php

namespace Modules\Index\Http\Controllers\Parts;

use App\Models\StockCodePrice;
use Illuminate\Http\Request;
use App\Models\StockCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class BulkCostingController extends Controller
{

	public static function get()
	{
		$rustart = getrusage();

		$batch = time();

		$testRecord = 0;

		$inv = DB::connection('syspro')
			->table('blueprintStockCodeView')
			->orderBy('StockCode')
			->chunk(100, function( $record ) use (&$testRecord, $batch){
				foreach( $record as $rec)
				{
					$LastPricePaid = ( isset( $rec->LastPrcUom ) && $rec->LastPrcUom === $rec->StockUom )
						? (float) $rec->LastPricePaid : 0;

					//		// ignore the last cost entered if the stock and order uom's don't match
					$LastCostEntered = ( isset( $rec->LastPrcUom ) && $rec->LastPrcUom === $rec->StockUom )
						? (float) $rec->LastCostEntered : 0;

					//		// add the material and labour costs from invMaster together
					$InvCost = (isset($rec->MaterialCost)) ? (float) $rec->MaterialCost + (float) $rec->LabourCost
						: 0;

					// group the calculated and retrieved costs
					$Costs = [
						"CalcLastPricePaid" => $LastPricePaid,
						"CalcLastPriceEntered" => $LastCostEntered,
						"CalcInvMasterCost" => $InvCost,
						"CalcUnitCost" => (float) $rec->UnitCost ?? 0,
					];

					$margin = 0;
					switch ( $rec->PriceCategory )
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


					$x = StockCodePrice::create( [
						'stockcode' => $rec->StockCode,
						'batch' => $batch,
						'cad_cost' =>  max($Costs),
						//	'costs' => $Costs,
						'retail_margin' => $margin,
						'price_category' => $rec->PriceCategory ?? 'A',
						'exchange_rate' => 1.27,
						'cad_dealer_discount' => 0.15,
						'usd_dealer_discount' => 0.15,
						'purchase_currency' => trim( $rec->Currency ) ?? "$",
					] );
					$x->save();
					$testRecord ++;

				}


			});





		function rutime($ru, $rus, $index) {
			return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
				-  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
		}

		$ru = getrusage();
		echo "This process used " . rutime($ru, $rustart, "utime") .
			" ms for its computations\n";
		echo "It spent " . rutime($ru, $rustart, "stime") .
			" ms in system calls\n";

		echo "Inserted {$testRecord} rows";

	//	return  true ;
	}

	public static function compare()
	{
		$results = [];
		StockCode::chunk(10, function($stockCode) use (&$results){
			foreach ($stockCode as $code)
			{
				$delta = $code->delta();
				if ( max($delta) / min( $delta) > 1.05 )
				{
					$results[] = $code;

				}

			}
			return false;
		});

		return $results;
	}


}


