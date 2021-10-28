<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleDate extends BaseModel
{

    protected $fillable = [
        'vehicle_id',
        'event_name',
        'user_id',
        'notes',
        'timestamp',
        'update_ford',
        'submitted_to_ford',
    ];

    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class );
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class );
    }
}
