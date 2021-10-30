<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Vehicle extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use Searchable;

    protected  $table = 'vehicles';

    protected  $hidden = [
        "raw_nhtsa_data",
    ];

    protected  $fillable = [
        'vin',
        'malley_number',
        'customer_number',
        'company_id',
        'user_id',
        'blueprint_id',
        'make',
        'model',
        'year',
        'exterior_colour',
        'interior_colour',
        'fuel',
        'engine',
        'manufacturer_code',
        'drive',
        'notes',
        'location',
        'work_order',  // 2020-04-23
        'customer_name',
        'country', // add 2020-06-05


        'refurb_number', // add 2020-06-23


        // boolean warranty flag
        'under_warranty',

        // chassis country
        'country',

        // json from NHTSA for future use?
        'raw_nhtsa_data',

        // tracked dates

        //2020-05-15
        'wheelbase',
        'roof_height',
        //end 2020-05-15


        'created_at',
        'updated_at',



        // serial numbers added 2020-04-17
        'suction_regulator_serial',
        'suction_pump_serial',
        'stretcher_serial',
        'stretcher_mount_serial',
        'o2_regulator_serial',
        'flow_meter_1_serial',
        'flow_meter_2_serial',
        'fast_idle_serial',
        'acetech_installer',
        'acetech_serial',
        'rctronics_serial',
        'rctronics_installer',

        'flow_meter_3_serial',
        'acetech_ambulance_file',
        'acetech_unique_number',
        'torque_tools_used',

        'wheelchair_lift_serial',
        'wheelchair_lift_model',
        'wheelchair_lift_manufacturer',
        'interlock_serial',
        'qstraint_serial_1',
        'qstraint_serial_2',
        'qstraint_serial_3',
        'qstraint_serial_4',


        // 2020-04-24
        'battery_1_serial',
        'battery_2_serial',
        'inverter_serial',
        'amplifier_serial',
        'siren_date',

         // 2020-04-28
        'FCA_T24',
        'FORD_17S15',
        'Ford_15E05',
        'FCA_VB2',
        'FCA_W00',
        'FORD_20B31',
        'link_seat_serial',
        'FORD_20B53', // 2011-04-12


        'CAAS_GVS_label_serial',
        'danhard_serial',
        'danhard_model',
        'stayco_step_serial',
        'stayco_step_model',



        // added fuel tank and weight columns
        'tank_volume',
        'base_weight_lf',
        'base_weight_rf',
        'base_weight_lr',
        'base_weight_rr',
        'base_raised_weight_lf',
        'base_raised_weight_rf',
        'base_raised_weight_lr',
        'base_raised_weight_rr',
        'base_fueled_weight_lf',
        'base_fueled_weight_rf',
        'base_fueled_weight_lr',
        'base_fueled_weight_rr',
        'base_raised_fueled_weight_lf',
        'base_raised_fueled_weight_rf',
        'base_raised_fueled_weight_lr',
        'base_raised_fueled_weight_rr',
        'tank_starting_fill_percent',


        // wegihts
        'oem_gvwr',
        'oem_front_gawr',
        'oem_rear_gawr',

        // seating locations
        "cab_seat_1_axel",
        "cab_seat_1_wheel",
        "cab_seat_1_used",
        "cab_seat_1_desc",
        "cab_seat_2_axel",
        "cab_seat_2_wheel",
        "cab_seat_2_used",
        "cab_seat_2_desc",

        "cab_seat_3_axel", // added june 23 2020
        "cab_seat_3_wheel", // added june 23 2020
        "cab_seat_3_used", // added june 23 2020
        "cab_seat_3_desc", // added june 23 2020

        "passenger_seat_1_axel",
        "passenger_seat_1_wheel",
        "passenger_seat_1_used",
        "passenger_seat_1_desc",
        "passenger_seat_2_axel",
        "passenger_seat_2_wheel",
        "passenger_seat_2_used",
        "passenger_seat_2_desc",
        "passenger_seat_3_axel",
        "passenger_seat_3_wheel",
        "passenger_seat_3_used",
        "passenger_seat_3_desc",
        "passenger_seat_4_axel",
        "passenger_seat_4_wheel",
        "passenger_seat_4_used",
        "passenger_seat_4_desc",
        "passenger_seat_5_axel",
        "passenger_seat_5_wheel",
        "passenger_seat_5_used",
        "passenger_seat_5_desc",
        "passenger_seat_6_axel",
        "passenger_seat_6_wheel",
        "passenger_seat_6_used",
        "passenger_seat_6_desc",
        "passenger_seat_7_axel",
        "passenger_seat_7_wheel",
        "passenger_seat_7_used",
        "passenger_seat_7_desc",
        "passenger_seat_8_axel",
        "passenger_seat_8_wheel",
        "passenger_seat_8_used",
        "passenger_seat_8_desc",
        "passenger_seat_9_axel",
        "passenger_seat_9_wheel",
        "passenger_seat_9_used",
        "passenger_seat_9_desc",
        "passenger_seat_10_axel",
        "passenger_seat_10_wheel",
        "passenger_seat_10_used",
        "passenger_seat_10_desc",
        "passenger_seat_11_axel",
        "passenger_seat_11_wheel",
        "passenger_seat_11_used",
        "passenger_seat_11_desc",
        "passenger_seat_12_axel",
        "passenger_seat_12_wheel",
        "passenger_seat_12_used",
        "passenger_seat_12_desc",
        "passenger_seat_13_axel",
        "passenger_seat_13_wheel",
        "passenger_seat_13_used",
        "passenger_seat_13_desc",
        "passenger_seat_14_axel",
        "passenger_seat_14_wheel",
        "passenger_seat_14_used",
        "passenger_seat_14_desc",
        "passenger_seat_15_axel",
        "passenger_seat_15_wheel",
        "passenger_seat_15_used",
        "passenger_seat_15_desc",
        "passenger_seat_16_axel",
        "passenger_seat_16_wheel",
        "passenger_seat_16_used",
        "passenger_seat_16_desc",



        // last itmes
        "wheel_size",
        "tire_size",
        "tire_diameter",
        "front_tread_width",
        "rear_tread_width",
        "front_tire_pressure",
        "rear_tire_pressure",
        "spare_tire_pressure",
        "o2_test_date",
        "o2_test_temperature",
        "os_test_start_pressure",
        "os_test_final_pressure",
        "ambulance_model",
        "ambulance_type",
        "alternator_amperage",

        'load_test_date',
        'load_test_1_lowest',
        'load_test_2_lowest',
        'load_test_1_highest',
        'load_test_2_highest',





        'front_axel_weight_with_fuel',
        'rear_axel_weight_with_fuel',
        'total_weight',
        'payload',


        // warranty
        'warranty_submitted',  // bit value to flag if a warranty has already been registered
        // customer name already exists
        'warranty_odometer',
        'warranty_selling_dealer',
        'customer_email',
        'customer_phone',
        'customer_address_1',
        'customer_address_2',
        'customer_city',
        'customer_province',
        'customer_postalcode',




        // added 2020-06-25 for lease docs for NBEMS
        'finance_invoice_number',
        'finance_pretax_invoice_value',
        'finance_invoice_total_tax',
        'finance_lease_number',
        'finance_monthly_lease_pretax',
        'finance_monthly_lease_tax',


        // 2021-02-17
        'oem_dealer',

        // 2021-10-15
        'weight_of_options', // added for BNQ compliance sticker
    ];

    public static function serialFields(): array
    {
        $fields = [
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


            // 2020-04-28
            'FCA_T24',
            'FORD_17S15',
            'Ford_15E05',
            'FORD_20B31',
            'link_seat_serial',
            'FCA_VB2',
            'FCA_W00',


            'CAAS_GVS_label_serial',
            'FORD_20B53' // added 2021-04-12

        ];
        sort( $fields );
        return  $fields;
    }





    /**
     * @return HasMany
     */
    public function dates(): HasMany
    {
        return $this->hasMany( VehicleDate::class )
            ->where('current', true)
            ->orderBy('timestamp', 'ASC');
    }




    /**
     * @return array
     */
    public static function woPrefixes(): array
    {
        $pref = [
            "ABLS",
            "UF",
            "MRE",
            "A",
            "R",
            "LF",
            "MO",
            "FR",
            "OUT",
            "DS",
            'QF',
        ];
        sort($pref);
        return $pref;
    }


    /**
     * @param string|null $value
     */
    public function setVinAttribute( string $value = null )
    {
        if ( is_null( $value ))
        {
            $this->attributes['vin'] = "";
        }
        else
        {
            $this->attributes['vin'] = strtoupper( $value );
        }
    }

    /**
     * @param string|null $value
     */
    public function setMalleyNumberAttribute( string $value = null )
    {
        if ( is_null( $value ))
        {
            $this->attributes['malley_number'] = "";
        }
        else
        {
            $this->attributes['malley_number'] = strtoupper( $value );
        }
    }

    /**
     * @param string|null $value
     */
    public function setCustomerNumberAttribute( string $value = null )
    {
        $this->attributes['customer_number'] = strtoupper( $value );
    }



    public function inspections()
    {
     //   return $this->hasMany('\App\Models\Inspection', 'vin', 'vin');
        return $this->hasMany('\App\Models\Inspection' )->orderBy('date_entered','DESC');
    }



    public function albums()
    {
        return $this->belongsToMany('\App\Models\Album', 'vehicle_albums' );
    }


    protected function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'vehicle_tags');
    }



    public function dealer()
    {
       return $this->belongsTo('\App\Models\Company','company_id','id');
    }

    public function creator()
    {
        return $this->belongsTo('\App\Models\User');
    }


    public function blueprint()
    {
        return $this->belongsTo( 'App\Models\Blueprint' );
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact','vehicle_contact');
    }

    public function getCustomerAttribute()
    {
        return $this->contacts()->where('contact_type','customer')
            ->first();
    }

//
//    public function dates()
//    {
//        return $this->hasMany('App\VehicleDate')
//            ->orderBy('start');
//    }


    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        $db =  $this->toArray();
        $db['identifier'] = $this->getIdentifierAttribute();

        return $db;
    }





    public function activeMilestones()
    {
        $results = [];
        foreach ($this->availableDates as $d)
        {
            if ($this->attributes[$d])
            {
                $results[$d] = $this->attributes[$d];
            }
        }
        return $results;
    }

    public function availableDates()
    {
        return $this->availableDates;
    }


    /**
     * @return string
     */
    public function getPinAttribute(): string
    {
        return strtoupper( substr( md5( $this->attributes['id']), 0,6 ) );
    }


    /**
     * @return string
     */
    public function getIdentifierAttribute(): string
    {

        return $this->firstWorkOrder()
            ?? $this->attributes['malley_number']
            ?? $this->attributes['vin'];
    }


    /**
     * @return string|null
     */
    public function firstWorkOrder(): ?string
    {
        if (strlen($this->attributes['work_order']) == 0) return null;

        $orders = explode(',', $this->attributes['work_order']);
        return trim( $orders[0] );
    }

    /**
     * clean up presentation
     * @return string
     */
    public function getWorkOrderAttribute(): string
    {
        $orders = explode(',', $this->attributes['work_order']);

        return implode(', ', $orders);
    }


    /**
     * work orders relates to the table work orders, whereas in the singular it refers to teh column on vehicles table
     *
     * @return HasMany
     */
    public function work_orders()
    {
        return $this->hasMany('\App\Models\WorkOrder');
    }



    /**
     * @param $query
     * @param $keyword
     * @return mixed
     */
     public function scopeSearchByKeyword($query, $keyword)
    {
        $query->where(function($query) use ($keyword) {
            $query->where('malley_number','like',"%{$keyword}%")
                  ->orWhere('vin','like',"%{$keyword}%")
                  ->orWhere('customer_number','like',"%{$keyword}%")
                  ->orWhereHas('contacts',function($s) use ($keyword){
                        $s->where('contact_type','customer')
                          ->where('company','like',"%{$keyword}%");
                  });
        });
        return $query->limit(10);
    }


    /**
     * @return string
     */
    public function getVehicleTileAttribute(): string
    {
        $flag = ($this->country) ? "<img src=".url('img/flags/'.$this->country.'.png')." />" : null;

        return "
            <li  class='list-group-item'>
                <div id='{$this->id}'>
                 <a href=".url('vehicles/'.$this->id).">{$this->identifier}</a> {$flag}
                 <br />{$this->make} {$this->model} {$this->year}
                 <br />{$this->dealer->name}
                </div>
            </li>
        ";
    }






    /**
     * @return null
     */
    public function getNextAttribute()
    {

        $a = Vehicle::query()
            ->orderBy('work_order')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos + 1,  $a)) ? $a[$pos + 1]: null;


    }


    /**
     * @return null or int
     */
    public function getPrevAttribute()
    {
        $a = Vehicle::query()
            ->orderBy('work_order')
            ->pluck('id')
            ->toArray();

        $pos = array_search($this->id, $a);

        return (array_key_exists($pos-1,  $a)) ? $a[$pos - 1] : null ;

    }




    /**
     * functions to deal with VIN validation
     */

    /**
     * @param string $c
     * @return int
     */
    private static function transliterate(string $c)
    {
        return strpos("0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ", $c) % 10;
    }

    /**
     * @param string $vin
     * @return string
     */
    private static function getCheckDigit(string $vin)
    {
        $map = "0123456789X";
        $weights = "8765432X098765432";
        $sum = 0;
        for ($i = 0; $i < 17; ++$i)
        {
            $sum += (  Vehicle::transliterate( $vin[$i] ) * stripos( $map, $weights[$i] ) );
        }
        $key = $sum % 11;

        return $map[$key];
    }

    /**
     * Is the vehicle's vin valid or not?
     * @return bool
     */
    public function getValidVinAttribute(): bool
    {
        $vin = $this->attributes['vin'];
        if (!$vin) return false;
        if (strlen($vin) !== 17) return false;

        return $this::getCheckDigit( $vin ) === substr( $vin, 8, 1 );
    }


    /**
     * @param string $vin
     * @return bool
     */
    public static function validVin( string $vin ): bool
    {
        if (!$vin) return false;
        if (strlen($vin) !== 17) return false;

        return Vehicle::getCheckDigit( $vin ) === substr( $vin, 8, 1 );
    }




    public function availableFields(): array
    {
        $ignore = [
            'created_at',
            'updated_at',
            'raw_nhtsa_data',
            'user_id',
            'company_id',
        ];

        return array_diff( $this->fillable, $ignore);
    }


    /**
     * @return int
     */
    public function getCabSeatsUsedAttribute(): int
    {
        $used = 0;
        for ($i = 1; $i <= 2; $i++)
        {
            $used += ( $this->attributes["cab_seat_{$i}_used"] ) ? 1 : 0;
        }
        return $used;
    }


    /**
     *
     * @return int
     */
    public function getPassengerSeatsUsedAttribute(): int
    {
        $used = 0;
        for ($i = 1; $i <= 16; $i++)
        {
            $used += ( $this->attributes["passenger_seat_{$i}_used"] ) ? 1 : 0;
        }
        return $used;
    }




}

