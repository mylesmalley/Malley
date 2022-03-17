<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InventoryItem extends BaseModel
{
    protected $table = 'inventory_items';


    protected $fillable = [
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

        'warehouse',
        'locale',
        'locked',
        'manually_added',

        'ticket_number',
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
        return $this->belongsTo(\App\Models\Inventory::class);
    }

    /**
     * @return HasMany
     */
    public function counts(): HasMany
    {
        return $this->hasMany(\App\Models\InventoryItemCount::class)
            ->orderBy('created_at', 'DESC');
    }

    /**
     * @return HasOne
     */
    public function latestCount(): HasOne
    {
        return $this->hasOne(\App\Models\InventoryItemCount::class)
            ->orderBy('created_at', 'DESC');
    }
}
