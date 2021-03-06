<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomLayout extends BaseModel
{
    public $timestamps = true;

    protected $table = 'custom_layouts';

    protected $fillable = [
        'blueprint_id',
        'name',
        'layout',
    ];

    /**
     * @return BelongsTo
     */
    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class);
    }
}
