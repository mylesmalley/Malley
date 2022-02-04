<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class VehicleSerial extends BaseModel
{
    protected $table = 'vehicle_serials';

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'vehicle_id',
        'key',
        'value',
    ];

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }


    /**
     * @param string $key
     */
    public function setKeyAttribute( string $key ): void
    {
        $this->attributes['key'] = strtoupper($key);
    }

    /**
     * @param string $key
     */
    public function setValueAttribute( string $value ): void
    {
        $this->attributes['value'] = strtoupper($value);
    }


}