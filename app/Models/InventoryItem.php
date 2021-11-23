<?php

namespace App\Models;

use App\Models\BaseModel;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\InventoryItem
 *
 * @property int $id
 * @property string $stock_code
 * @property string $description_1
 * @property string|null $description_2
 * @property string|null $bin
 * @property string|null $group
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $unit_of_measure
 * @property string $expected_quantity
 * @property bool|null $locked
 * @property int|null $inventory_id
 * @property string|null $cost
 * @property string|null $locale
 * @property string|null $warehouse
 * @property string|null $last_issued_date
 * @property string|null $supplier
 * @property int|null $manually_added
 * @property int|null $ticket_number
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InventoryItemCount[] $counts
 * @property-read int|null $counts_count
 * @property-read null $next_i_d
 * @property-read null $next_uncounted_i_d
 * @property-read null $previous_i_d
 * @property-read null $previous_uncounted_i_d
 * @property-read \App\Models\Inventory|null $inventory
 * @property-read \App\Models\InventoryItemCount|null $latestCount
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereBin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereDescription1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereDescription2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereExpectedQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereLastIssuedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereManuallyAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereStockCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereSupplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereTicketNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereUnitOfMeasure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereWarehouse($value)
 * @mixin \Eloquent
 */
class InventoryItem extends BaseModel
{

	protected string  $table = 'inventory_items';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable= [
        'id',

        // timestamps
	    'created_at',
	    'updated_at',

        'stock_code',
        'description_1',
        'description_2',

        'inventory_id',

        'bin',
        'group',

        'expected_quantity',
        'unit_of_measure',
        'unit_price',


        'locked',
        'manually_added',

        'ticket_number' // manual ticket number for a count
    ];


    /**
     * Get the format for database stored dates.
     *
     * @return string
     */
    public function getDateFormat(): string
    {
        return 'Y-m-d H:i:s.u0';
    }



    /**
     * @return BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo('App\Models\Inventory');
    }




    public function counts(): HasMany
    {
        return $this->hasMany('App\Models\InventoryItemCount')
            ->orderBy('created_at', 'DESC');
    }

    public function latestCount()
    {
        return $this->hasOne('App\Models\InventoryItemCount')
            ->orderBy('created_at', 'DESC');
    }




    /**
     * @return null
     */
    public function getNextIDAttribute()
    {
        $a = DB::table('Inventory_Latest_Counts')

    //    $a = InventoryItem::query()
            ->where([
                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
        [ 'group', '=', strtoupper( $this->attributes['group'] )]
             //   [ 'obsolete', '=', false]
            ])
            //  ->andWhere('obsolete','=',false)

            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos + 1,  $a)) ? $a[$pos + 1]: null;


    }


    /**
     * @return null
     */
    public function getNextUncountedIDAttribute()
    {
        $a = DB::table('Inventory_Latest_Counts')

            //    $a = InventoryItem::query()
            ->where([
                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
                [ 'group', '=', strtoupper( $this->attributes['group'] )]
                //   [ 'obsolete', '=', false]
            ])
            //  ->andWhere('obsolete','=',false)
            ->whereNotIn('line_status', ["Accepted", "Matched"])
            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos + 1,  $a)) ? $a[$pos + 1]: null;


    }




    /**
     * @return null or int
     */
    public function getPreviousIDAttribute()
    {

        $a = DB::table('Inventory_Latest_Counts')
//        $a = InventoryItem::query()
            ->where([
                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
                [ 'group', '=', strtoupper( $this->attributes['group'] )]
                //   [ 'obsolete', '=', false]
            ])
            //  ->andWhere('obsolete','=',false)

            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos-1,  $a)) ? $a[$pos - 1] : null ;

    }





    /**
     * @return null or int
     */
    public function getPreviousUncountedIDAttribute()
    {

        $a = DB::table('Inventory_Latest_Counts')
//        $a = InventoryItem::query()
            ->where([
                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
                [ 'group', '=', strtoupper( $this->attributes['group'] )]
                //   [ 'obsolete', '=', false]
            ])
            //  ->andWhere('obsolete','=',false)
            ->whereNotIn('line_status', ["Accepted", "Matched"])

            ->orderBy('bin')
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos-1,  $a)) ? $a[$pos - 1] : null ;

    }


}
