<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\WorkOrderLine
 *
 * @property int $id
 * @property int $work_order_id
 * @property int|null $order
 * @property string|null $description
 * @property string|null $part_number
 * @property int|null $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkOrder $work_order
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine wherePartNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrderLine whereWorkOrderId($value)
 * @mixin \Eloquent
 */
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
        return $this->belongsTo(\App\Models\WorkOrder::class);
    }
}
