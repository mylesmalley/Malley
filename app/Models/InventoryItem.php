<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class InventoryItem extends BaseModel
{

	protected $table = 'inventory_items';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable= [
        'id',
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

        'ticket_number'
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


//    /**
//     *
//     */
//    protected static function boot()
//    {
//        parent::boot();
//
//        // When being retrieved, decrypt the attributes.
//        static::retrieved(function ($instance) {
//
//            if (Cache::has('inventory_item_position_'.$instance->attributes['id'])) {
//                $dates = Cache::get('inventory_item_position_'.$instance->attributes['id']);
//            }
//            else
//            {
//                $dates = $instance->place_in_series();
//            }
//
//            $instance->attributes['nextID'] = $dates->next;
//            $instance->attributes['nextUncountedID'] = $dates->next_uncounted;
//            $instance->attributes['previousID'] = $dates->previous;
//            $instance->attributes['previousUncountedID'] = $dates->previous_uncounted;
//
//        });
//
//    }





//    /**
//     * @return object
//     */
//    public function place_in_series(): object
//    {
//
//        if (Cache::has('inventory_item_position_'.$this->attributes['id']))
//        {
//            return Cache::get('inventory_item_position_'.$this->attributes['id']);
//        }
//        else
//        {
//
//
//        // next or previous
//        $all = DB::table('Inventory_Latest_Counts')
//            ->select(['id','inventory_id','bin','group'])
//            ->where([
//                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
//                [ 'group', '=', strtoupper( $this->attributes['group'] )]
//            ])
//            ->orderBy('bin')
//            ->orderBy('id')
//            ->pluck('id')
//            ->toArray();
//
//        $pos = array_search($this->id, $all);
//
//
//        $uncounted = DB::table('Inventory_Latest_Counts')
//            ->select(['id','inventory_id','bin','group'])
//            ->where([
//                [ 'inventory_id', '=', $this->attributes['inventory_id'] ],
//                [ 'group', '=', strtoupper( $this->attributes['group'] )]
//            ])
//            ->orderBy('bin')
//            ->orderBy('id')
//            ->pluck('id')
//            ->toArray();
//
//        $pos_2 = array_search($this->id, $uncounted);
//
//
//
//            $output = json_decode(json_encode([
//                "next" => (array_key_exists($pos + 1,  $all))
//                    ? $all[$pos + 1]: null,
//                "previous" =>  (array_key_exists($pos-1,  $all))
//                    ? $all[$pos - 1] : null,
//                "next_uncounted" => (array_key_exists($pos_2 + 1,  $uncounted))
//                    ? $uncounted[$pos_2 + 1]: null,
//                "previous_uncounted" =>  (array_key_exists($pos_2-1,  $uncounted))
//                    ? $uncounted[$pos_2 - 1] : null,
//            ]));
//
//            Cache::put('inventory_item_position_'.$this->attributes['id'], $output );
//
//            return $output;
//        }
//
//
//    }









}
