<?php

namespace App\Models;

//use App\Models\BaseModel;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Component
 *
 * @property int $id
 * @property int $option_id
 * @property string|null $component_sub_assembly
 * @property string|null $component_stock_code
 * @property string|null $component_description
 * @property string|null $component_part_category
 * @property string|null $component_material_qty
 * @property float|null $component_material_cost
 * @property string|null $component_unit_of_measure
 * @property string|null $component_revision
 * @property string|null $component_item_code
 * @property string|null $component_where_built_location
 * @property string|null $component_install_area
 * @property string|null $component_notes
 * @property float $labour_cost
 * @property string|null $component_long_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $component_labour_cost
 * @property string $component_price_category
 * @property-read float $total_cost
 * @property-read \App\Models\Option $option
 * @method static \Illuminate\Database\Eloquent\Builder|Component newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Component query()
 * @method static \Illuminate\Database\Eloquent\Builder|Component searchByKeyword($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentInstallArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentItemCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentLabourCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentMaterialCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentMaterialQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentPartCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentPriceCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentRevision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentStockCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentSubAssembly($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentUnitOfMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereComponentWhereBuiltLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereLabourCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Component whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Component extends \App\Models\BaseModel
{
    protected array $fillable=
    [
        'option_id',
        'component_sub_assembly',
        'component_stock_code',
        'component_description',
        'component_long_description',
        'component_part_category',
        'component_material_qty',
        'component_material_cost',
        // 'component_labour_qty',
        // 'component_labour_cost',
        'component_unit_of_measure',
        'component_revision',
        'component_item_code',
        'component_where_built_location',
        'component_install_area',
        'component_notes',
	    "component_price_category",

    ];
    /**
     * @var mixed
     */

    /**
     * uppercase the stock code
     */
    public function setComponentStockCodeAttribute( $value )
    {
        return $this->attributes['component_stock_code'] = strtoupper($value);
    }

    /**
     * uppercase teh description
     */
    public function setComponentDescriptionAttribute( $value )
    {
        return $this->attributes['component_description'] = strtoupper($value);
    }

    /**
     * force upper case long description
     */
    public function setComponentLongDescriptionAttribute( $value )
    {
        return $this->attributes['component_long_description'] = strtoupper($value);
    }

    /**
     * force uppercase UOM
     */
    public function setComponentUnitOfMeasureAttribute( $value )
    {
        return $this->attributes['component_unit_of_measure'] = strtoupper($value);
    }


    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];

    // protected $dateFormat = "Y-m-d H:i:s.u";


    public function option()
    {
    	return $this->belongsTo('App\Models\Option');
    }


    /*
        RETURNS MATERIAL COST. LABOUR COST TIED IN WITH PARTS.
        ASSEMBLY LABOUR ON TEH OPTION RECORD, NOT COMPONENTS
     */
    public function getTotalCostAttribute(): float
    {
        return ( $this->attributes['component_material_qty'] * $this->attributes['component_material_cost']) ;
    }


	public static function priceCategory()
	{
		$components = DB::table('components')
			->select('component_stock_code')
			->distinct('component_stock_code')
			->get()
			->pluck('component_stock_code');

		$syspro = DB::connection('syspro')
				->table('InvMaster')
				->select('StockCode','PriceCategory')
				->whereIn('StockCode', $components)
				->get();

		foreach( $syspro as $sys )
		{
			DB::table('components')
				->where('component_stock_code', '=', trim( $sys->StockCode ))
				->update([ 'component_price_category' => trim( $sys->PriceCategory ) ]);
		}

		return $syspro;
	}




    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword) {

            $keyword = strtoupper( $keyword );

            $query->where(function ($query) use ($keyword) {
                $query->select(['id', 'component_stock_code', 'component_description','component_long_description'])
                    ->where('component_stock_code', 'like', "%{$keyword}%")
                    ->orWhere('component_description', 'like', "%{$keyword}%")
                    ->orWhere('component_long_description', 'like', "%{$keyword}%")
                    ->orWhereHas('option', function ($q) use ($keyword) {
                        $q->where('option_name', 'like', "%{$keyword}%");
                    });
            });
        }
        return $query->limit(10);
    }

}
