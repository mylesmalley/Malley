<?php

namespace App\Models;

use App\Models\BaseModel;

class Inventory extends BaseModel
{
    protected $table = 'inventory';


    protected $fillable = [
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
        return $this->belongsTo(\App\Models\User::class);
    }

    public function items()
    {
        return $this->hasMany(\App\Models\InventoryItem::class);
    }
}
