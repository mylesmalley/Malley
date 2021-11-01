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

        // newly required
        'incoming_inspection',    // Inspection Complete
        'work_scheduled' , // Work Scheduled
        'work_expected_to_be_completed', // Work Estimated to be Completed
        'work_started', // Work Started
        'work_completed', // Work Completed
        'released_to_carrier', // Released to Carrier
        'compound_exit',  // Compound Exit

        // optional fields for Ford
        'pre_production_damage_identified', //Damage Identified
    ];


    /**
     * @var array
     * key : malley milestone    value : ford milestone code
     */
    protected static array $ford_mapping = [
        'arrival' => 'R1', // Vehicle Received

        // newly required
        'incoming_inspection'  =>  'XB',    // Inspection Complete
        'work_scheduled' => 'AV', // Work Scheduled
        'work_expected_to_be_completed' => 'X2', // Work Estimated to be Completed
        'work_started' => 'X6', // Work Started
        'work_completed' => 'X5', // Work Completed
        'released_to_carrier' => 'J1', // Released to Carrier
        'compound_exit' => 'OA',  // Compound Exit

        // optional fields for Ford
        'pre_production_damage_identified' => 'A0', //Damage Identified
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
