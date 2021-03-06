<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TemplateOption extends BaseModel
{
    protected $fillable = [
        'option_id',
        'template_id',
    ];

    public $timestamps = false;

    protected $table = 'template_options';

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Template::class);
    }

    /**
     * @return HasOne
     */
    public function option(): HasOne
    {
        return $this->hasOne(\App\Models\Option::class);
    }
}
