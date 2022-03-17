<?php

namespace App\Models;

use App\Models\Traits\ReadOnlyModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\StockCode
 *
 * @property-read float $c_a_d_cost
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StockCodePrice[] $history
 * @property-read int|null $history_count
 * @property-read \App\Models\StockCodePrice|null $latestPricing
 * @method static \Illuminate\Database\Eloquent\Builder|StockCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockCode query()
 * @mixin \Eloquent
 */
class StockCode extends Model
{
    use ReadOnlyModelTrait;

    protected $connection = 'syspro';

    /**
     * custom view on the sql server under SysproCompanyM
     * @var string
     */
    protected $table = 'blueprintStockCodeView';

    protected $primaryKey = 'StockCode';

    public $incrementing = false;

    public $keyType = 'string';

    public $timestamps = false;

    public $with = ['latestPricing'];

    /**
     * @return HasOne
     */
    public function latestPricing() : HasOne
    {
        return $this->hasOne(\App\Models\StockCodePrice::class,
            'stockcode', 'StockCode')->latest();
    }

    /**
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(\App\Models\StockCodePrice::class,
            'stockcode', 'StockCode')
            ->orderBy('updated_at', 'DESC');
    }

    /**
     * @return float
     */
    public function getCADCostAttribute(): float
    {
        //	 ignore the last price paid if the stock and order uom's don't match
        $LastPricePaid = ($this->LastPrcUom === $this->StockUom)
            ? (float) $this->LastPricePaid : 0;

        //	ignore the last cost entered if the stock and order uom's don't match
        $LastCostEntered = ($this->LastPrcUom === $this->StockUom)
            ? (float) $this->LastCostEntered : 0;

        //add the material and labour costs from invMaster together
        $InvCost = (float) $this->MaterialCost + (float) $this->LabourCost;

        // group the calculated and retrieved costs
        $Costs = [
            'CalcLastPricePaid' => $LastPricePaid,
            'CalcLastPriceEntered' => $LastCostEntered,
            'CalcInvMasterCost' => $InvCost,
            'CalcUnitCost' => (float) $this->UnitCost,
        ];

        return max($Costs);
    }

    public function delta()
    {
        $latestSaved = $this->latestPricing;

        return [$latestSaved->cad_cost, $this->cad_cost];
    }
}
