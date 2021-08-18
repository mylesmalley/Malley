<?php

namespace App\Models;

use App\Models\BaseModel;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class InventoryItem extends BaseModel
{

	protected $table = 'inventory_items';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
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
