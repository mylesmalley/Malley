<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkOrderLine extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'work_order_lines';


    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'work_order_id',
        'order',
        'description',
        'part_number',
        'quantity',
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo
     */
    public function work_order(): BelongsTo
    {
        return $this->belongsTo('App\Models\WorkOrder');
    }
}
