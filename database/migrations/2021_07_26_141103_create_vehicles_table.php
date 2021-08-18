<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {

            // id stuff
            $table->id();
            $table->timestamps();
            $table->integer('company_id')->default(2);
            $table->integer('user_id')->default(3);
            $table->integer('blueprint_id');
            $table->string('vin', 17);
            $table->string('malley_number', 32);
            $table->string('customer_name',100);
            $table->string('customer_number', 20);
            $table->string('work_order');
            $table->string('oem_dealer');
            $table->string('refurb_number');

            $table->string('warranty_selling_dealer');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_address_1');
            $table->string('customer_address_2');
            $table->string('customer_city');
            $table->string('customer_province');
            $table->string('customer_postalcode');


            // vehicle data from nhtsa
            $table->string('make', 20);
            $table->string('model', 20);
            $table->integer('year');
            $table->string('exterior_colour', 20)->default('White');
            $table->string('interior_colour', 20);
            $table->string('fuel', 255)->default('Gas');
            $table->string('engine', 255);
            $table->string('drive', 255);
            $table->text('notes');
            $table->string('manufacturer_code');
            $table->text('raw_nhtsa_data');

            $table->string('roof_height');
            $table->string('wheelbase');


            // other specs
            $table->string('location');
            $table->string('status');



            // serials
            $table->string('suction_regulator_serial');
            $table->string('suction_pump_serial');
            $table->string('stretcher_serial');
            $table->string('stretcher_mount_serial');
            $table->string('o2_regulator_serial');
            $table->string('flow_meter_1_serial');
            $table->string('flow_meter_2_serial');
            $table->string('fast_idle_serial');
            $table->string('acetech_installer');
            $table->string('acetech_serial');

            $table->string('rctronics_serial');
            $table->string('rctronics_installer');
            $table->string('flow_meter_3_serial');
            $table->string('acetech_ambulance_file');
            $table->string('acetech_unique_number');
            $table->string('wheelchair_lift_serial');
            $table->string('wheelchair_lift_model');
            $table->string('wheelchair_lift_manufacturer');
            $table->string('qstraint_serial_1');
            $table->string('qstraint_serial_2');
            $table->string('qstraint_serial_3');
            $table->string('qstraint_serial_4');
            $table->string('interlock_serial');

            $table->string('torque_tools_used');
            $table->string('battery_1_serial');
            $table->string('battery_2_serial');
            $table->string('inverter_serial');
            $table->string('siren_date');
            $table->string('FCA_T24');
            $table->string('FORD_17S15');
            $table->string('Ford_15E05');
            $table->string('FCA_VB2');
            $table->string('FCA_W00');
            $table->string('CAAS_GVS_label_serial');

            $table->string('stayco_step_serial');
            $table->string('stayco_step_model');
            $table->string('FORD_20B31');
            $table->string('link_seat_serial');
            $table->string('FORD_20B53');
            $table->string('danhard_serial');
            $table->string('danhard_model');


            // testing fields
            $table->integer('tank_volume')->default(1);

            $table->integer('base_weight_lf')->default(0);
            $table->integer('base_weight_rf')->default(0);
            $table->integer('base_weight_lr')->default(0);
            $table->integer('base_weight_rr')->default(0);

            $table->integer('base_raised_weight_lf')->default(0);
            $table->integer('base_raised_weight_rf')->default(0);
            $table->integer('base_raised_weight_lr')->default(0);
            $table->integer('base_raised_weight_rr')->default(0);
            $table->integer('base_fueled_weight_lf')->default(0);
            $table->integer('base_fueled_weight_rf')->default(0);
            $table->integer('base_fueled_weight_lr')->default(0);
            $table->integer('base_fueled_weight_rr')->default(0);

            $table->integer('base_raised_fueled_weight_lf')->default(0);
            $table->integer('base_raised_fueled_weight_rf')->default(0);
            $table->integer('base_raised_fueled_weight_lr')->default(0);
            $table->integer('base_raised_fueled_weight_rr')->default(0);

            $table->integer('tank_starting_fill_percent')->default(0);

            $table->integer('oem_gvwr');
            $table->integer('oem_front_gawr');
            $table->integer('oem_rear_gawr');

            // seat locations and weights
            $table->float('cab_seat_1_axel');
            $table->float('cab_seat_1_wheel');
            $table->boolean('cab_seat_1_used');
            $table->string('cab_seat_1_desc', 40);

            $table->float('cab_seat_2_axel');
            $table->float('cab_seat_2_wheel');
            $table->boolean('cab_seat_2_used');
            $table->string('cab_seat_2_desc', 40);

            $table->float('cab_seat_3_axel');
            $table->float('cab_seat_3_wheel');
            $table->boolean('cab_seat_3_used');
            $table->string('cab_seat_3_desc', 40);


            $table->float('passenger_seat_1_axel');
            $table->float('passenger_seat_1_wheel');
            $table->boolean('passenger_seat_1_used');
            $table->string('passenger_seat_1_desc', 40);

            $table->float('passenger_seat_2_axel');
            $table->float('passenger_seat_2_wheel');
            $table->boolean('passenger_seat_2_used');
            $table->string('passenger_seat_2_desc', 40);

            $table->float('passenger_seat_3_axel');
            $table->float('passenger_seat_3_wheel');
            $table->boolean('passenger_seat_3_used');
            $table->string('passenger_seat_3_desc', 40);

            $table->float('passenger_seat_4_axel');
            $table->float('passenger_seat_4_wheel');
            $table->boolean('passenger_seat_4_used');
            $table->string('passenger_seat_4_desc', 40);

            $table->float('passenger_seat_5_axel');
            $table->float('passenger_seat_5_wheel');
            $table->boolean('passenger_seat_5_used');
            $table->string('passenger_seat_5_desc', 40);

            $table->float('passenger_seat_6_axel');
            $table->float('passenger_seat_6_wheel');
            $table->boolean('passenger_seat_6_used');
            $table->string('passenger_seat_6_desc', 40);

            $table->float('passenger_seat_7_axel');
            $table->float('passenger_seat_7_wheel');
            $table->boolean('passenger_seat_7_used');
            $table->string('passenger_seat_7_desc', 40);

            $table->float('passenger_seat_8_axel');
            $table->float('passenger_seat_8_wheel');
            $table->boolean('passenger_seat_8_used');
            $table->string('passenger_seat_8_desc', 40);

            $table->float('passenger_seat_9_axel');
            $table->float('passenger_seat_9_wheel');
            $table->boolean('passenger_seat_9_used');
            $table->string('passenger_seat_9_desc', 40);

            $table->float('passenger_seat_10_axel');
            $table->float('passenger_seat_10_wheel');
            $table->boolean('passenger_seat_10_used');
            $table->string('passenger_seat_10_desc', 40);

            $table->float('passenger_seat_11_axel');
            $table->float('passenger_seat_11_wheel');
            $table->boolean('passenger_seat_11_used');
            $table->string('passenger_seat_11_desc', 40);

            $table->float('passenger_seat_12_axel');
            $table->float('passenger_seat_12_wheel');
            $table->boolean('passenger_seat_12_used');
            $table->string('passenger_seat_12_desc', 40);

            $table->float('passenger_seat_13_axel');
            $table->float('passenger_seat_13_wheel');
            $table->boolean('passenger_seat_13_used');
            $table->string('passenger_seat_13_desc', 40);

            $table->float('passenger_seat_14_axel');
            $table->float('passenger_seat_14_wheel');
            $table->boolean('passenger_seat_14_used');
            $table->string('passenger_seat_14_desc', 40);

            $table->float('passenger_seat_15_axel');
            $table->float('passenger_seat_15_wheel');
            $table->boolean('passenger_seat_15_used');
            $table->string('passenger_seat_15_desc', 40);

            $table->float('passenger_seat_16_axel');
            $table->float('passenger_seat_16_wheel');
            $table->boolean('passenger_seat_16_used');
            $table->string('passenger_seat_16_desc', 40);


            $table->string('wheel_size', 20);
            $table->string('tire_size', 20);

            $table->float('tire_diameter');
            $table->float('front_tread_width');
            $table->float('rear_tread_width');
            $table->float('front_tire_pressure');
            $table->float('rear_tire_pressure');
            $table->float('spare_tire_pressure');

            // 02 test
            $table->date('o2_test_date');
            $table->float('o2_test_temperature');
            $table->float('os_test_start_pressure');
            $table->float('os_test_final_pressure');

            $table->string('ambulance_model', 20);
            $table->string('ambulance_type', 20);


            $table->integer('alternator_amperage');
            $table->float('load_test_2_highest');
            $table->float('load_test_1_highest');
            $table->float('load_test_2_lowest');
            $table->float('load_test_1_lowest');
            $table->date('load_test_date');


            $table->string('country', 20);

            // DATES
            $table->date('date_arrival');
            $table->string('date_arrival_notes');

            $table->date('date_delivery');
            $table->string('date_delivery_notes');

            $table->date('date_warranty_expiry');
            $table->string('date_warranty_expiry_notes');

            $table->date('date_lease_expired');
            $table->string('date_lease_expired_notes');

            $table->date('date_entry_to_canada');
            $table->string('date_entry_to_canada_notes');

            $table->date('date_exit_from_canada');
            $table->string('date_exit_from_canada_notes');

            $table->date('date_at_york_or_thornton');
            $table->string('date_at_york_or_thornton_notes');

            $table->date('date_in_service');
            $table->string('date_in_service_notes');

            $table->date('date_lease_expiry_of_refurb');
            $table->string('date_lease_expiry_of_refurb_notes');

            $table->date('date_warranty_expires');
            $table->string('date_warranty_expires_notes');

            $table->date('date_next_renewal');
            $table->string('date_next_renewal_notes');

            $table->date('date_chassis_manufactured');
            $table->string('date_chassis_manufactured_notes');

            $table->date('date_warranty_registered');
            $table->string('date_warranty_registered_notes');

            $table->date('date_of_purchase');
            $table->string('date_of_purchase_notes');

            $table->date('date_malley_finished_conversion');
            $table->string('date_malley_finished_conversion_notes');

            $table->date('date_leaving_malley_facility');
            $table->string('date_leaving_malley_facility_notes');

//            $table->date('date_x');
//            $table->string('date_x_notes');


            $table->integer('front_axel_weight_with_fuel');
            $table->integer('rear_axel_weight_with_fuel');
            $table->integer('total_weight');
            $table->integer('payload');

            $table->boolean('warranty_submitted')->default(0);
            $table->integer('warranty_odometer');




            // finance
            $table->string('finance_invoice_number', 20);
            $table->float('finance_pretax_invoice_value');
            $table->float('finance_invoice_total_tax');
            $table->string('finance_lease_number', 50);
            $table->float('finance_monthly_lease_pretax');
            $table->float('finance_monthly_lease_tax');

        });

        DB::statement("
                ALTER TABLE vehicles ADD
    computed_vehicle_number as right(left([work_order], 8), 4),
    first_work_order as left([work_order], 8)
            ") ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
