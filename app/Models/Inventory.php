<?php

namespace App\Models;

use App\Models\BaseModel;

/**
 * App\Models\Inventory
 *
 * @property int $id
 * @property string $description
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $locked
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InventoryItem[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUserId($value)
 * @mixin \Eloquent
 */
class Inventory extends BaseModel
{

	protected string  $table = 'inventory';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable= [
        'id',

        // timestamps
	    'created_at',
	    'updated_at',
        'user_id',
        'description',
        'locked',
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



    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }


    public function items()
    {
        return $this->hasMany('App\Models\InventoryItem');
    }


}
