<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LayoutOption
 *
 * @property int $id
 * @property int $layout_id
 * @property int $option_id
 * @property float $x_pos
 * @property float $y_pos
 * @property float $qty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Layout $layout
 * @property-read \App\Models\Option $option
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereLayoutId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereOptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereXPos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayoutOption whereYPos($value)
 * @mixin \Eloquent
 */
class LayoutOption extends BaseModel
{
    protected $table = 'layout_options';

    protected $fillable = [
        'layout_id',
        'option_id',
        'x_pos',
        'y_pos',
        'qty',
    ];

    public function layout()
    {
        return $this->belongsTo(\App\Models\Layout::class);
    }

    public function option()
    {
        return $this->belongsTo(\App\Models\Option::class);
    }
}
