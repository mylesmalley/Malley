<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\ReadOnlyModelTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class StockCode extends Model
{
	use ReadOnlyModelTrait;
	
	protected $connection = "syspro";
	
	/**
	 * custom view on the sql server under SysproCompanyM
	 * @var string
	 */
	protected $table = "blueprintStockCodeView";
	
	protected $primaryKey = "StockCode";
	
	public $incrementing = false;
	
	public $keyType =  'string';
	
	public $timestamps = false;
	
	public $with = ['latestPricing'];
	
	/**
	 * @return HasOne
	 */
	public function latestPricing() : HasOne
	{
		return $this->hasOne('App\Models\StockCodePrice',
			'stockcode', "StockCode")->latest();
	}
	
	
	/**
	 * @return HasMany
	 */
	public function history(): HasMany
	{
		return $this->hasMany('App\Models\StockCodePrice',
			'stockcode', "StockCode")
			->orderBy('updated_at', 'DESC');
	}
	
	/**
	 * @return float
	 */
	public function getCADCostAttribute(): float
	{
		//	 ignore the last price paid if the stock and order uom's don't match
		$LastPricePaid = ( $this->LastPrcUom === $this->StockUom )
			? (float) $this->LastPricePaid : 0;

		//	ignore the last cost entered if the stock and order uom's don't match
		$LastCostEntered = ( $this->LastPrcUom === $this->StockUom )
			? (float) $this->LastCostEntered : 0;

		//add the material and labour costs from invMaster together
		$InvCost = (float) $this->MaterialCost + (float) $this->LabourCost;
		
		// group the calculated and retrieved costs
		$Costs = [
			"CalcLastPricePaid" => $LastPricePaid,
			"CalcLastPriceEntered" => $LastCostEntered,
			"CalcInvMasterCost" => $InvCost,
			"CalcUnitCost" => (float) $this->UnitCost,
		];
		
		
		return max( $Costs );
	}
	
	

	
	
	
	public function delta()
	{
		$latestSaved = $this->latestPricing;
		
		return [ $latestSaved->cad_cost, $this->cad_cost ];
	}
	

}