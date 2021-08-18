<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StockCodePrice extends Model
{
    protected $table = "stockcode_prices";

    protected $connection = "mssql";

    protected $fillable = [
	    'id',
		'stockcode',
		'batch',
		'purchase_currency',
		'exchange_rate',
		'cad_cost',
		'price_category',
		'retail_margin',
		'cad_dealer_discount',
		'usd_dealer_discount'
	];

	/**
	 * @return BelongsTo
	 */
    public function parent(): BelongsTo
    {
    	return $this->belongsTo('App\Models\StockCode');
    }

	/**
	 * @return float
	 */
    public function getCADCostAttribute(): float
    {
	    return number_format( $this->attributes['cad_cost'], 2 );
    }

	/**
	 * @return float
	 */
    public function getRetailPriceCADAttribute(): float
	{
		$calc = (float) $this->attributes['cad_cost'] /
			( 1 - ( (float) $this->attributes['retail_margin'] ) );
		return number_format( $calc, 2 );
	}




}
