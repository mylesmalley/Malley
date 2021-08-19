<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property int|null $blueprint_id
 * @property string|null $vin
 * @property string|null $malley_number
 * @property string|null $customer_number
 * @property string|null $make
 * @property string|null $model
 * @property int|null $year
 * @property string|null $exterior_colour
 * @property string|null $interior_colour
 * @property string|null $fuel
 * @property string|null $engine
 * @property string|null $drive
 * @property string|null $notes
 * @property string|null $manufacturer_code
 * @property string|null $raw_nhtsa_data
 * @property string|null $location
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $customer_name
 * @property string|null $suction_regulator_serial
 * @property string|null $suction_pump_serial
 * @property string|null $stretcher_serial
 * @property string|null $stretcher_mount_serial
 * @property string|null $o2_regulator_serial
 * @property string|null $flow_meter_1_serial
 * @property string|null $flow_meter_2_serial
 * @property string|null $fast_idle_serial
 * @property string|null $acetech_installer
 * @property string|null $acetech_serial
 * @property string|null $rctronics_serial
 * @property string|null $rctronics_installer
 * @property string|null $flow_meter_3_serial
 * @property string|null $acetech_ambulance_file
 * @property string|null $acetech_unique_number
 * @property string|null $wheelchair_lift_serial
 * @property string|null $wheelchair_lift_model
 * @property string|null $wheelchair_lift_manufacturer
 * @property string|null $qstraint_serial_1
 * @property string|null $qstraint_serial_2
 * @property string|null $qstraint_serial_3
 * @property string|null $qstraint_serial_4
 * @property string|null $interlock_serial
 * @property string|null $torque_tools_used
 * @property string $work_order
 * @property string|null $battery_1_serial
 * @property string|null $battery_2_serial
 * @property string|null $amplifier_serial
 * @property string|null $inverter_serial
 * @property string|null $siren_date
 * @property string|null $FCA_T24
 * @property string|null $FORD_17S15
 * @property string|null $Ford_15E05
 * @property string|null $FCA_VB2
 * @property string|null $FCA_W00
 * @property string|null $CAAS_GVS_label_serial
 * @property string|null $roof_height
 * @property string|null $wheelbase
 * @property int|null $tank_volume
 * @property int|null $base_weight_lf
 * @property int|null $base_weight_rf
 * @property int|null $base_weight_lr
 * @property int|null $base_weight_rr
 * @property int|null $base_raised_weight_lf
 * @property int|null $base_raised_weight_rf
 * @property int|null $base_raised_weight_lr
 * @property int|null $base_raised_weight_rr
 * @property int|null $base_fueled_weight_lf
 * @property int|null $base_fueled_weight_rf
 * @property int|null $base_fueled_weight_lr
 * @property int|null $base_fueled_weight_rr
 * @property int|null $base_raised_fueled_weight_lf
 * @property int|null $base_raised_fueled_weight_rf
 * @property int|null $base_raised_fueled_weight_lr
 * @property int|null $base_raised_fueled_weight_rr
 * @property int|null $tank_starting_fill_percent
 * @property int|null $oem_gvwr
 * @property int|null $oem_front_gawr
 * @property int|null $oem_rear_gawr
 * @property float|null $cab_seat_1_axel
 * @property float|null $cab_seat_1_wheel
 * @property bool|null $cab_seat_1_used
 * @property string|null $cab_seat_1_desc
 * @property float|null $cab_seat_2_axel
 * @property float|null $cab_seat_2_wheel
 * @property bool|null $cab_seat_2_used
 * @property string|null $cab_seat_2_desc
 * @property float|null $passenger_seat_1_axel
 * @property float|null $passenger_seat_1_wheel
 * @property bool|null $passenger_seat_1_used
 * @property string|null $passenger_seat_1_desc
 * @property float|null $passenger_seat_2_axel
 * @property float|null $passenger_seat_2_wheel
 * @property bool|null $passenger_seat_2_used
 * @property string|null $passenger_seat_2_desc
 * @property float|null $passenger_seat_3_axel
 * @property float|null $passenger_seat_3_wheel
 * @property bool|null $passenger_seat_3_used
 * @property string|null $passenger_seat_3_desc
 * @property float|null $passenger_seat_4_axel
 * @property float|null $passenger_seat_4_wheel
 * @property bool|null $passenger_seat_4_used
 * @property string|null $passenger_seat_4_desc
 * @property string|null $wheel_size
 * @property string|null $tire_size
 * @property float|null $tire_diameter
 * @property float|null $front_tread_width
 * @property float|null $rear_tread_width
 * @property float|null $front_tire_pressure
 * @property float|null $rear_tire_pressure
 * @property float|null $spare_tire_pressure
 * @property string|null $o2_test_date
 * @property float|null $o2_test_temperature
 * @property float|null $os_test_start_pressure
 * @property float|null $os_test_final_pressure
 * @property string|null $ambulance_model
 * @property string|null $ambulance_type
 * @property int|null $alternator_amperage
 * @property float|null $load_test_2_highest
 * @property float|null $load_test_1_highest
 * @property float|null $load_test_2_lowest
 * @property float|null $load_test_1_lowest
 * @property string|null $load_test_date
 * @property float|null $passenger_seat_5_axel
 * @property float|null $passenger_seat_5_wheel
 * @property bool|null $passenger_seat_5_used
 * @property string|null $passenger_seat_5_desc
 * @property float|null $passenger_seat_6_axel
 * @property float|null $passenger_seat_6_wheel
 * @property bool|null $passenger_seat_6_used
 * @property string|null $passenger_seat_6_desc
 * @property float|null $passenger_seat_7_axel
 * @property float|null $passenger_seat_7_wheel
 * @property bool|null $passenger_seat_7_used
 * @property string|null $passenger_seat_7_desc
 * @property float|null $passenger_seat_8_axel
 * @property float|null $passenger_seat_8_wheel
 * @property bool|null $passenger_seat_8_used
 * @property string|null $passenger_seat_8_desc
 * @property float|null $passenger_seat_9_axel
 * @property float|null $passenger_seat_9_wheel
 * @property bool|null $passenger_seat_9_used
 * @property string|null $passenger_seat_9_desc
 * @property float|null $passenger_seat_10_axel
 * @property float|null $passenger_seat_10_wheel
 * @property bool|null $passenger_seat_10_used
 * @property string|null $passenger_seat_10_desc
 * @property float|null $passenger_seat_11_axel
 * @property float|null $passenger_seat_11_wheel
 * @property bool|null $passenger_seat_11_used
 * @property string|null $passenger_seat_11_desc
 * @property float|null $passenger_seat_12_axel
 * @property float|null $passenger_seat_12_wheel
 * @property bool|null $passenger_seat_12_used
 * @property string|null $passenger_seat_12_desc
 * @property float|null $passenger_seat_13_axel
 * @property float|null $passenger_seat_13_wheel
 * @property bool|null $passenger_seat_13_used
 * @property string|null $passenger_seat_13_desc
 * @property float|null $passenger_seat_14_axel
 * @property float|null $passenger_seat_14_wheel
 * @property bool|null $passenger_seat_14_used
 * @property string|null $passenger_seat_14_desc
 * @property float|null $passenger_seat_15_axel
 * @property float|null $passenger_seat_15_wheel
 * @property bool|null $passenger_seat_15_used
 * @property string|null $passenger_seat_15_desc
 * @property float|null $passenger_seat_16_axel
 * @property float|null $passenger_seat_16_wheel
 * @property bool|null $passenger_seat_16_used
 * @property string|null $passenger_seat_16_desc
 * @property string|null $country
 * @property string|null $date_arrival
 * @property string|null $date_arrival_notes
 * @property string|null $date_delivery
 * @property string|null $date_delivery_notes
 * @property string|null $date_warranty_expiry
 * @property string|null $date_warranty_expiry_notes
 * @property string|null $date_lease_expired
 * @property string|null $date_lease_expired_notes
 * @property string|null $date_entry_to_canada
 * @property string|null $date_entry_to_canada_notes
 * @property string|null $date_exit_from_canada
 * @property string|null $date_exit_from_canada_notes
 * @property string|null $date_at_york_or_thornton
 * @property string|null $date_at_york_or_thornton_notes
 * @property string|null $date_in_service
 * @property string|null $date_in_service_notes
 * @property string|null $date_lease_expiry_of_refurb
 * @property string|null $date_lease_expiry_of_refurb_notes
 * @property string|null $date_warranty_expires
 * @property string|null $date_warranty_expires_notes
 * @property string|null $date_next_renewal
 * @property string|null $date_next_renewal_notes
 * @property int|null $front_axel_weight_with_fuel
 * @property int|null $rear_axel_weight_with_fuel
 * @property int|null $total_weight
 * @property int|null $payload
 * @property string|null $date_chassis_manufactured
 * @property string|null $date_chassis_manufactured_notes
 * @property bool|null $warranty_submitted
 * @property int|null $warranty_odometer
 * @property string|null $warranty_selling_dealer
 * @property string|null $customer_email
 * @property string|null $customer_phone
 * @property string|null $customer_address_1
 * @property string|null $customer_address_2
 * @property string|null $customer_city
 * @property string|null $customer_province
 * @property string|null $customer_postalcode
 * @property string|null $date_warranty_registered
 * @property string|null $date_warranty_registered_notes
 * @property bool|null $cab_seat_3_used
 * @property string|null $date_of_purchase
 * @property string|null $date_of_purchase_notes
 * @property float|null $cab_seat_3_axel
 * @property float|null $cab_seat_3_wheel
 * @property string|null $cab_seat_3_desc
 * @property string|null $refurb_number
 * @property string|null $danhard_serial
 * @property string|null $danhard_model
 * @property string|null $date_malley_finished_conversion
 * @property string|null $date_malley_finished_conversion_notes
 * @property string|null $finance_invoice_number
 * @property float|null $finance_pretax_invoice_value
 * @property float|null $finance_invoice_total_tax
 * @property string|null $finance_lease_number
 * @property float|null $finance_monthly_lease_pretax
 * @property float|null $finance_monthly_lease_tax
 * @property string|null $stayco_step_serial
 * @property string|null $stayco_step_model
 * @property string|null $FORD_20B31
 * @property string|null $link_seat_serial
 * @property string|null $computed_vehicle_number
 * @property string|null $first_work_order
 * @property string|null $oem_dealer
 * @property string|null $FORD_20B53
 * @property string|null $date_leaving_malley_facility
 * @property string|null $date_leaving_malley_facility_notes
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Album[] $albums
 * @property-read int|null $albums_count
 * @property-read \App\Models\Blueprint|null $blueprint
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contact[] $contacts
 * @property-read int|null $contacts_count
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\Company $dealer
 * @property-read int $cab_seats_used
 * @property-read mixed $customer
 * @property-read string $identifier
 * @property-read null $next
 * @property-read int $passenger_seats_used
 * @property-read string $pin
 * @property-read null $prev
 * @property-read bool $valid_vin
 * @property-read string $vehicle_tile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspections
 * @property-read int|null $inspections_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\App\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WorkOrder[] $work_orders
 * @property-read int|null $work_orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle searchByKeyword($keyword)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAcetechAmbulanceFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAcetechInstaller($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAcetechSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAcetechUniqueNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAlternatorAmperage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAmbulanceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAmbulanceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereAmplifierSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseFueledWeightLf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseFueledWeightLr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseFueledWeightRf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseFueledWeightRr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedFueledWeightLf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedFueledWeightLr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedFueledWeightRf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedFueledWeightRr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedWeightLf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedWeightLr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedWeightRf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseRaisedWeightRr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseWeightLf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseWeightLr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseWeightRf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBaseWeightRr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBattery1Serial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBattery2Serial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCAASGVSLabelSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat1Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat1Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat1Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat1Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat2Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat2Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat2Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat2Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat3Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat3Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat3Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCabSeat3Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereComputedVehicleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerPostalcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCustomerProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDanhardModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDanhardSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateArrival($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateArrivalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateAtYorkOrThornton($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateAtYorkOrThorntonNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateChassisManufactured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateChassisManufacturedNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateDeliveryNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateEntryToCanada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateEntryToCanadaNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateExitFromCanada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateExitFromCanadaNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateInService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateInServiceNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeaseExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeaseExpiredNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeaseExpiryOfRefurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeaseExpiryOfRefurbNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeavingMalleyFacility($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateLeavingMalleyFacilityNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateMalleyFinishedConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateMalleyFinishedConversionNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateNextRenewal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateNextRenewalNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateOfPurchase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateOfPurchaseNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyExpiresNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyExpiryNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyRegistered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDateWarrantyRegisteredNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereDrive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereExteriorColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFCAT24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFCAVB2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFCAW00($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFORD17S15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFORD20B31($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFORD20B53($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFastIdleSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinanceInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinanceInvoiceTotalTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinanceLeaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinanceMonthlyLeasePretax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinanceMonthlyLeaseTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFinancePretaxInvoiceValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFirstWorkOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFlowMeter1Serial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFlowMeter2Serial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFlowMeter3Serial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFord15E05($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFrontAxelWeightWithFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFrontTirePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFrontTreadWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereInteriorColour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereInterlockSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereInverterSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLinkSeatSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLoadTest1Highest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLoadTest1Lowest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLoadTest2Highest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLoadTest2Lowest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLoadTestDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereMalleyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereManufacturerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereO2RegulatorSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereO2TestDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereO2TestTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOemDealer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOemFrontGawr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOemGvwr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOemRearGawr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOsTestFinalPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereOsTestStartPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat10Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat10Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat10Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat10Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat11Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat11Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat11Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat11Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat12Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat12Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat12Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat12Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat13Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat13Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat13Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat13Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat14Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat14Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat14Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat14Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat15Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat15Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat15Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat15Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat16Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat16Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat16Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat16Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat1Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat1Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat1Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat1Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat2Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat2Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat2Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat2Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat3Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat3Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat3Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat3Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat4Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat4Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat4Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat4Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat5Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat5Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat5Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat5Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat6Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat6Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat6Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat6Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat7Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat7Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat7Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat7Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat8Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat8Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat8Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat8Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat9Axel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat9Desc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat9Used($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePassengerSeat9Wheel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereQstraintSerial1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereQstraintSerial2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereQstraintSerial3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereQstraintSerial4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRawNhtsaData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRctronicsInstaller($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRctronicsSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRearAxelWeightWithFuel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRearTirePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRearTreadWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRefurbNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereRoofHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSirenDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSpareTirePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereStaycoStepModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereStaycoStepSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereStretcherMountSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereStretcherSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSuctionPumpSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereSuctionRegulatorSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTankStartingFillPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTankVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTireDiameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTireSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTorqueToolsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereTotalWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereVin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWarrantyOdometer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWarrantySellingDealer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWarrantySubmitted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWheelSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWheelbase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWheelchairLiftManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWheelchairLiftModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWheelchairLiftSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereWorkOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereYear($value)
 * @mixin \Eloquent
 */
class Vehicle extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    use Searchable;

    protected $table = 'vehicles';

    protected $hidden = [
        "raw_nhtsa_data",
    ];

  //  protected $connection = "mssql";

    protected $fillable = [
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



        // date and notes fields added 2020 06 05
        'date_arrival',
        'date_arrival_notes',
        'date_delivery',
        'date_delivery_notes',
        'date_warranty_expiry',
        'date_warranty_expiry_notes',
        'date_lease_expired',
        'date_lease_expired_notes',
        "date_lease_expiry_of_refurb",
        "date_lease_expiry_of_refurb_notes",
        "date_warranty_expiry",
        "date_warranty_expiry_notes",
        "date_entry_to_canada",
        "date_entry_to_canada_notes",
        "date_exit_from_canada",
        "date_exit_from_canada_notes",
        "date_at_york_or_thornton",
        "date_arrived_at_york_or_thornton_notes",
        "date_in_service",
        "date_in_service_notes",
        'date_next_renewal',
        'date_next_renewal_notes',
        'date_of_purchase',
        'date_of_purchase_notes',

        // added 2021-06-03
        'date_leaving_malley_facility',
        'date_leaving_malley_facility_notes',

        // added 2020-06-18
        'date_warranty_registered',
        'date_warranty_registered_notes',

        // added 2020-06-11
        'date_chassis_manufactured',
        'date_chassis_manufactured_notes',

        // added 2020-06-24
        'date_malley_finished_conversion',
        'date_malley_finished_conversion_notes',

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



    public static function dateFields(): array
{
    return [
        'date_arrival',
        'date_delivery',
        'date_lease_expired',
        "date_lease_expiry_of_refurb",
        "date_entry_to_canada",
        "date_exit_from_canada",
        "date_at_york_or_thornton",
        "date_in_service",
        'date_next_renewal',
        'date_chassis_manufactured',
        'date_malley_finished_conversion', // added 2020-06-24
        'date_warranty_registered', // added 2020-06-18
        "date_warranty_expiry",
        'date_of_purchase',
        'date_leaving_malley_facility', // added 2021-06-03
        ];
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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

