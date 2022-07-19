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
        'location',
    ];

    protected static array $locations =
    [
        'N / A',
        'At Malley',
        'Off site; coming back',
    ];

    /**
     * @return array|string[]
     */
    public static function locations()
    {
        return self::$locations;
    }

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected static array $events = [
        'confirmed_location',
        'sent_out_for_service',
        'arrival',
        'at_york_or_thornton',
        'chassis_manufactured',
        'compound_exit',  // Compound Exit
        'delivered_by_malley', // same as released to carrier but for when we ship it ourselves
        'entry_to_canada',
        'exit_from_canada',
        'expected_delivery',
        'incoming_inspection',    // Inspection Complete
        'in_service',
        'lease_expiry',
        'lease_expiry_of_refurb',
        'leaving_malley_facility',
        'next_renewal',
        'of_purchase',
        'pre_production_damage_identified', //Damage Identified
        'released_to_carrier', // Released to Carrier
        'warranty_expiry',
        'warranty_registered',
        'work_completed', // Work Completed
        'work_expected_to_be_completed', // Work Estimated to be Completed
        'work_scheduled', // Work Scheduled
        'work_started', // Work Started

        // added 2022-07-17 as per request from michelle

        'returned_for_refurb',
        'delivered_as_refurb',
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
        'delivered_by_malley' => 'J1', // Released to Carrier substitute for Malley delivered ourselves

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
    public static function ford_milestone_code(string $event_name): string
    {
        return self::$ford_mapping[$event_name] ?? 'ERROR';
    }

    /**
     * returns the keys from the ford Milestones list to compare with the full dates table list
     *
     * @return array
     */
    public static function ford_milestone(): array
    {
        return array_keys(self::$ford_mapping);
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
     * tries to determine if ford should be notified. first instance of an event of a type,
     * only for Ford vans. otherwise ignore.
     *
     * @param Vehicle $vehicle
     * @param string $milestone
     * @return bool
     */
    public static function ford_update_required(Vehicle $vehicle, string $milestone): bool
    {
        $existing_milestones = $vehicle->milestones()->toArray();
        $existing_milestones = array_keys($existing_milestones);
        // ignore non-ford vans
        if (strtoupper($vehicle->make) === 'FORD'
            // only ping needed milestones
            && in_array($milestone, self::ford_milestone())
            // only ping first-of events for this van
            && ! in_array($milestone, $existing_milestones)) {
            return true;
        }

        // or don't let them know at all.
        return false;
    }

    /**
     * pulls everything together and then formats to send vehicle milestone to Ford.
     *
     * @return array
     */
    #[ArrayShape(['vin' => 'string', 'code' => 'string', 'statusUpdateTs' => 'string', 'references' => "\string[][]"])]
    public function freight_verify_api_payload(): array
    {
        return [
            'vin' => (string) $this->vehicle->vin,
            'code' => $this->ford_milestone_code($this->attributes['name']),
            'statusUpdateTs' => (string) $this->attributes['timestamp'],
            'references' => [
                [
                    'qualifier' => 'senderName',
                    'value' => 'Malley Industries Inc.',
                ],
                [
                    'qualifier' => 'receiverCode',
                    'value' => 'FORDIT',
                ],
                [
                    'qualifier' => 'scac',
                    'value' => 'MALLEY',
                ],
                [
                    'qualifier' => 'ms1LocationCode',
                    'value' => ($this->attributes['name'] !== 'arrival') ? 'UX' : 'CB3893',
                ],
                [
                    'qualifier' => 'ms1StateOrProvinceCode',
                    'value' => 'NB',
                ],
                [
                    'qualifier' => 'ms1CountryCode',
                    'value' => 'Canada',
                ],
                [
                    'qualifier' => 'compoundCode',
                    'value' => ($this->attributes['name'] !== 'arrival') ? 'UX' : 'CB3893',
                ],
                [
                    'qualifier' => 'yardCode',
                    'value' => 'NA',
                ],
                [
                    'qualifier' => 'bayCode',
                    'value' => 'NA',
                ],
                [
                    'qualifier' => 'partnerType',
                    'value' => 'UP',
                ],
            ],
        ];
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
