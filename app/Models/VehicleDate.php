<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\ArrayShape;

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
        'lease_expirey',
        'leaving_malley_facility',
        //'malley_finished_conversion', // replaced with work_completed. updated database
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
//        'pre_production_damage_identified' => 'A0', //Damage Identified
    ];


    /**
     * returns the short milestone code from Ford
     *
     * @param string $event_name
     * @return string
     */
    public static function ford_milestone_code( string $event_name ): string
    {
        return self::$ford_mapping[ $event_name ] ?? 'ERROR';
    }


    /**
     * returns the keys from the ford Milestones list to compare with the full dates table list
     *
     * @return array
     */
    public static function ford_milestone(): array
    {
        return array_keys( self::$ford_mapping );
    }


    /**
     * returns a list of all available date milestones that can be added to a vehicle.
     *
     * @return array
     */
    public static function available_events(): array
    {
        return self::$events;
    }


    /**
     * @return array
     */
    #[ArrayShape(["vin" => "string", "code" => "string", "statusUpdateTs" => "string", "references" => "\string[][]"])]
    public function freight_verify_api_payload(): array
    {
        return [
            "vin" => (string) $this->vehicle->vin,
            "code" => $this->ford_milestone_code($this->attributes['name']),
            "statusUpdateTs" => (string) $this->attributes['timestamp'],
            "references" => [
                [
                    "qualifier" => "senderName",
                    "value" => "Malley Industries Inc."
                ],
                [
                    "qualifier" => "receiverCode",
                    "value" => "FORDIT",
                ],
                [
                    "qualifier" => "scac",
                    "value" => "MALLEY",
                ],
                [
                    "qualifier" => "ms1LocationCode",
                    "value" => ($this->attributes['name'] !== 'arrival') ? "UX" : 'CB3893'
                ],
                [
                    "qualifier" => "ms1StateOrProvinceCode",
                    "value" => "NB",
                ],
                [
                    "qualifier" => "ms1CountryCode",
                    "value" => "Canada",
                ],
                [
                    "qualifier" => "compoundCode",
                    "value" => ($this->attributes['name'] !== 'arrival') ? "UX" : 'CB3893'
                ],
                [
                    "qualifier" => "yardCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "bayCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "partnerType",
                    "value" => "UP",
                ]
            ]
        ];
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
