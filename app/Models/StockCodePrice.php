<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\StockCodePrice
 *
 * @property int $id
 * @property string $stockcode
 * @property int $batch
 * @property string $purchase_currency
 * @property float $exchange_rate
 * @property float $cad_cost
 * @property string $price_category
 * @property float $retail_margin
 * @property float $cad_dealer_discount
 * @property float $usd_dealer_discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read float $c_a_d_cost
 * @property-read float $retail_price_c_a_d
 * @property-read \App\Models\StockCode $parent
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereBatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereCadCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereCadDealerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice wherePriceCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice wherePurchaseCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereRetailMargin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereStockcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockCodePrice whereUsdDealerDiscount($value)
 * @mixin \Eloquent
 */
class StockCodePrice extends Model
{
    protected string  $table = "stockcode_prices";

    protected $connection = "mssql";

    protected $fillable= [
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
