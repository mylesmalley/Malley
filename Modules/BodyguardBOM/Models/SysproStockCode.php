<?php

namespace Modules\BodyguardBOM\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class SysproStockCode extends Model
{

    public $timestamps = false;

    protected $table = 'bg_syspro_components';

    protected $fillable = [
        'stock_code',
        'quantity',
        'bg_kit_id',
        'id',
    ];

    /**
     * @return BelongsTo
     */
    public function kit(): BelongsTo
    {
        return $this->belongsTo(
            Kit::class,
            'bg_kit_id',
        );
    }




}
