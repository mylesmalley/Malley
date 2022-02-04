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

    public static array $fields = [
        'suction_regulator_serial',
        'suction_pump_serial',
        'stretcher_serial',
        'stretcher_mount_serial',
        'o2_regulator_serial',
        'flow_meter_1_serial',
        'flow_meter_2_serial',
        'flow_meter_3_serial',
        'danhard_serial', // 2020-06-23
        'danhard_model', // 2020-06-23
        'stayco_step_serial', // 2020-06-26
        'stayco_step_model', // 2020-06-26
        'fast_idle_serial',
        'acetech_installer',
        'torque_tools_used',
        'acetech_ambulance_file',
        'acetech_unique_number',
        'wheelchair_lift_serial',
        'wheelchair_lift_model',
        'wheelchair_lift_manufacturer',
        'interlock_serial',
        'qstraint_serial_1',
        'qstraint_serial_2',
        'qstraint_serial_3',
        'qstraint_serial_4',
        'battery_1_serial',
        'battery_2_serial',
        'inverter_serial',
        'amplifier_serial',
        'siren_date',
        'FCA_T24', // 2020-04-28
        'FORD_17S15',
        'Ford_15E05',
        'FORD_20B31',
        'link_seat_serial',
        'FCA_VB2',
        'FCA_W00',
        'CAAS_GVS_label_serial',
        'FORD_20B53' // added 2021-04-12
    ];


    /**
     * @return array
     */
    public static function available_serials(): array
    {
        $arr = self::$fields;
        sort( $arr );
        return $arr;
    }



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