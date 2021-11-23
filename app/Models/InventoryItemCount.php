<?php

namespace App\Models;

use App\Models\BaseModel;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\InventoryItemCount
 *
 * @property int $id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $inventory_item_id
 * @property string|null $counted
 * @property string|null $counter_name
 * @property bool|null $accepted
 * @property bool|null $recounted
 * @property-read \App\Models\InventoryItem $item
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereCounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereCounterName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereInventoryItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereRecounted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItemCount whereUserId($value)
 * @mixin \Eloquent
 */
class InventoryItemCount extends BaseModel
{

	protected string  $table = 'inventory_item_counts';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable= [
        'id',
        'created_at',
	    'updated_at',
        'counted',
        'counter_name',
        'user_id',
        'inventory_item_id',
        'accepted',
        'recounted',
    ];


    /**
     * @return BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo('App\Models\InventoryItem');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }



}
