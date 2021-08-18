<?php

namespace App\Models;

use App\Models\BaseModel;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;


class InventoryItemCount extends BaseModel
{

	protected $table = 'inventory_item_counts';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
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
