<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleDate extends BaseModel
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'vehicle_id', // int
        'name', // nvarchar50
        'user_id', //int
        'notes', //nvarchar255
        'timestamp', //datetime2
        'update_ford', // bit
        'submitted_to_ford', // but
        'current', //bit
    ];


    /**
     * @var bool
     */
    public $timestamps = true;


    /**
     * @var array
     */
    protected static array $events = [
        "at_york_or_thornton",
        "entry_to_canada",
        "exit_from_canada",
        "in_service",
        "lease_expiry_of_refurb",
        "warranty_expiry",
        'arrival',
        'chassis_manufactured',
        'delivery',
        'lease_expired',
        'leaving_malley_facility',
        'malley_finished_conversion',
        'next_renewal',
        'of_purchase',
        'warranty_registered',
    ];


    /**
     * @var array
     */
    protected static array $ford_mapping = [

    ];


    public function ford_milestone()
    {

    }


    /**
     * @return array
     */
    public static function available_events(): array
    {
        return self::$events;
    }










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
