@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">Regulatory Info for <a href="/vehicles/{{ $vehicle->id}} ">
                    {{ $vehicle->identifier }}
                </a></h1>
        </div>
    </div>

    @includeIf('vehicles::errors')


    <form name="regulatory" method="POST" action="{{ url('vehicles/'.$vehicle->id.'/regulatory') }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div id="vue">


        <div class="row">
            <div class="col-md-12">
                <h1>Templates</h1>

            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <input type="reset" class="btn btn-danger btn-sm" value="RESET">
                <input type="button" onclick="clearForm()" class="btn btn-danger btn-sm" value="CLEAR">
                <button type="button"
                        onclick="transit2020ambAWD()"
                        class="btn btn-secondary btn-sm">Transit Ambulance AWD</button>


                <button type="button"
                        onclick="transit2020ambRWD()"
                        class="btn btn-secondary btn-sm">Transit Ambulance RWD</button>

{{--                <button type="button"--}}
{{--                        onclick="transit2019amb()"--}}
{{--                        class="btn btn-secondary btn-sm">2019 Transit Ambulance RWD</button>--}}


                <button type="button"
                        onclick="promaster2020amb()"
                        class="btn btn-secondary btn-sm"> ProMaster Ambulance</button>

{{--                <button type="button"--}}
{{--                        onclick="promaster2019amb()"--}}
{{--                        class="btn btn-secondary btn-sm">2019 ProMaster Ambulance</button>--}}


                <button type="button"
                        onclick="transit2020mobility()"
                        class="btn btn-dark btn-sm">Transit Mid Roof Mobility RWD </button>

                <button type="button"
                        onclick="promaster2020mobility()"
                        class="btn btn-dark btn-sm"> ProMaster Mobility</button>

                <button type="button"

                        onclick="transitConnectMobility()"
                        class="btn btn-info btn-sm">Transit Connect Mobility</button>

                <button type="button"
                        disabled
                        onclick="alert('Not yet defined')"
                        class="btn btn-info btn-sm">Grand Caravan Mobility</button>

                <button type="button"
                        disabled
                        onclick="alert('Not yet defined')"
                        class="btn btn-info btn-sm">Transit Ext Mobility</button>

                <button type="button"
                        disabled
                        onclick="alert('Not yet defined')"
                        class="btn btn-info btn-sm">Transit High Roof Mobility</button>



            </div>
        </div>




<br> <br>
            <div class="row">
                <div class="col-md-12">
                    <h1>Stickers</h1>
                    <p>Make sure you save any changes before clicking to see stickers.</p>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary" href="{{ route('vehicle.stickers', [$vehicle]) }}">Canadian Stickers</a>
                    <a  class="btn btn-info"  href="{{ route('vehicle.stickers', [$vehicle, 'us']) }}">American Stickers</a>
                    <a  class="btn btn-secondary"  href="{{ route('vehicle.stickers', [$vehicle, 'qc']) }}">BNQ Stickers</a>
                </div>
            </div>



















                    <div id="regulatory_form">


            <br>


            <h3>Vehicle Details </h3>
            <div class='row'>
                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="date_chassis_manufactured">Date Chassis Manufactured </label>
                        <input type="date"
                               name="date_chassis_manufactured"
                               value="{{ old('date_chassis_manufactured') ?? $vehicle->date_chassis_manufactured ?? "" }}"
                               id="date_chassis_manufactured"
                               class="form-control">
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="date_malley_finished_conversion">Date Malley Completed Work </label>
                        <input type="date"
                               name="date_malley_finished_conversion"
                               value="{{ old('date_malley_finished_conversion') ?? $vehicle->date_malley_finished_conversion ?? "" }}"
                               id="date_malley_finished_conversion"
                               class="form-control">
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="manufacturer_code">Vehicle Type </label>
                        <input type="text"
                               name="manufacturer_code"
                               value=" {{ old('manufacturer_code') ?? $vehicle->manufacturer_code ?? "" }}"
                               id="manufacturer_code"
                               class="form-control">
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="ambulance_type">Ambulance Type </label>
                        <input type="text"
                               name="ambulance_type"
                               value=" {{ old('ambulance_type') ?? $vehicle->ambulance_type ?? "" }}"
                               id="ambulance_type"
                               class="form-control">
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="ambulance_model">Ambulance Model </label>
                        <input type="text"
                               name="ambulance_model"
                               value=" {{ old('ambulance_model') ?? $vehicle->ambulance_model ?? "" }}"
                               id="ambulance_model"
                               class="form-control">
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="CAAS_GVS_label_serial">CAAS GVS Label Serial# </label>
                        <input type="text"
                               name="CAAS_GVS_label_serial"
                               value=" {{ old('CAAS_GVS_label_serial') ?? $vehicle->CAAS_GVS_label_serial ?? "" }}"
                               id="CAAS_GVS_label_serial"
                               class="form-control">
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class="form-group">
                        <label class="control-label" for="alternator_amperage">Alternator Amperage </label>
                        <div class="input-group">

                        <input type="text"
                               name="alternator_amperage"
                               value=" {{ old('alternator_amperage') ?? $vehicle->alternator_amperage ?? "" }}"
                               id="alternator_amperage"
                               class="form-control">
                            <span class="input-group-text" title='Amperes'>A</span>

                        </div>
                    </div>
                </div>
            </div>

            <br>


        <h3>Fuel </h3>

        <div class='row'>
            <div class='col-md-4  ambulance  '>
                <div class="form-group">
                    <label class="control-label" for="fuel">Fuel </label>
                    <input type="text"
                           name="fuel"
                           value="{{ old('fuel') ?? $vehicle->fuel ?? '' }}"
                           v-model="fuelType"
                           id="fuel"
                           class="form-control">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label" for="tank_volume">Tank Size </label>
                    <div class="input-group">
                        <input type="number"
                               step="1"
                               name="tank_volume"
                               id="tank_volume"
                               value="{{ old('tank_volume') ?? $vehicle->tank_volume ?? '' }}"
                               v-model.number="tankSize"
                               class="form-control">
                        <span class="input-group-text" title='Volume in Litres'>Litres</span>
                    </div>
                </div>
            </div>


        </div>



        <br>


                @includeIf('vehicles::info.wheels')



        <br><br>
                @includeIf('vehicles::info.weight')

            <br><br>

                @includeIf('vehicles::info.load')

<br><br>
                @includeIf('vehicles::info.o2')

        <br><br>
        @includeIf('vehicles::info.seating')



        <br><br>

                @includeIf('vehicles::info.fuel')




                <br><br>

                <div class="row text-center">
                    <div class='col-md-12'>
                        <h1 class="display-4">Weights and Payload</h1>
                    </div>
                </div>

                <div class="row text-center">
                    <div class='offset-4 col-md-4'>
                        <div class="form-group">
                            <label class="control-label" for="front_axel_weight_with_fuel">Front Axel Weight</label>
                            <div class="input-group">
                                <input type="text"
                                       readonly
                                       v-model.number="front_axel_weight_with_fuel"
                                       name="front_axel_weight_with_fuel"
                                       value="{{ old('front_axel_weight_with_fuel') ?? $vehicle->front_axel_weight_with_fuel ?? "" }}"
                                       id="front_axel_weight_with_fuel"
                                       class="form-control">
                                <span class="input-group-text" title='lb'>lb</span>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <div class='offset-4 col-md-4'>
                        <div class="form-group">
                            <label class="control-label" for="rear_axel_weight_with_fuel">Rear Axel Weight</label>
                            <div class="input-group">
                                <input type="text"
                                       readonly
                                       v-model.number="rear_axel_weight_with_fuel"

                                       name="rear_axel_weight_with_fuel"
                                       value="{{ old('rear_axel_weight_with_fuel') ?? $vehicle->rear_axel_weight_with_fuel ?? "" }}"
                                       id="rear_axel_weight_with_fuel"
                                       class="form-control">
                                <span class="input-group-text" title='lb'>lb</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center">
                    <div class='offset-4 col-md-4'>
                        <div class="form-group">
                            <label class="control-label" for="total_weight">Total Weight</label>
                            <div class="input-group">
                                <input type="text"
                                       readonly
                                       v-model.number="total_weight"

                                       name="total_weight"
                                       value="{{ old('total_weight') ?? $vehicle->total_weight ?? "" }}"
                                       id="total_weight"
                                       class="form-control">
                                <span class="input-group-text" title='lb'>lb</span>
                            </div>
                        </div>
                    </div>

                </div>


                        <div class="row text-center">
                            <div class='offset-4 col-md-4'>
                                <div class="form-group">
                                    <label class="control-label" for="total_weight">Weight of Options</label>
                                    <div class="input-group">
                                        <input type="number"
                                               v-model.number="weight_of_options"

                                               name="weight_of_options"
                                               value="{{ old('weight_of_options') ?? $vehicle->weight_of_options ?? "" }}"
                                               id="weight_of_options"
                                               class="form-control">
                                        <span class="input-group-text" title='lb'>lb</span>
                                    </div>
                                </div>
                            </div>

                        </div>





                <div class="row text-center">
                    <div class='offset-4 col-md-4'>
                        <div class="form-group">
                            <label class="control-label" for="payload">Payload</label>
                            <div class="input-group">
                                <input type="text"
                                       readonly
                                       v-model.number="payload"
                                       name="payload"
                                       value="{{ old('payload') ?? $vehicle->payload ?? "" }}"
                                       id="payload"
                                       class="form-control">
                                <span class="input-group-text" title='lb'>lb</span>
                            </div>
                        </div>
                    </div>

                </div>








            </div>




        </div>

        <div class="row">
            <input type="submit" class="btn btn-primary" value="Save Changes" >
        </div>


    </form>



@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script>
        let vue = new Vue({
                el: "#vue",
                data: {
                    tankSize: {{ old('tank_volume') ?? $vehicle->tank_volume ?? 0 }},
                    fuelLevel: {{ old('tank_starting_fill_percent') ?? $vehicle->tank_starting_fill_percent ?? 0 }},
                    fuelType: "{{ old('fuel') ?? $vehicle->fuel ?? '' }}",
                    base_weight_rr: {{ old('base_weight_rr') ?? $vehicle->base_weight_rr ?? 0 }},
                    base_weight_rf: {{ old('base_weight_rf') ?? $vehicle->base_weight_rf ?? 0 }},
                    base_weight_lf: {{ old('base_weight_lf') ?? $vehicle->base_weight_lf ?? 0 }},
                    base_weight_lr: {{ old('base_weight_lr') ?? $vehicle->base_weight_lr ?? 0 }},
                    base_raised_weight_rr: {{ old('base_raised_weight_rr') ?? $vehicle->base_raised_weight_rr ?? 0 }},
                    base_raised_weight_rf: {{ old('base_raised_weight_rf') ?? $vehicle->base_raised_weight_rf ?? 0 }},
                    base_raised_weight_lf: {{ old('base_raised_weight_lf') ?? $vehicle->base_raised_weight_lf ?? 0 }},
                    base_raised_weight_lr: {{ old('base_raised_weight_lr') ?? $vehicle->base_raised_weight_lr ?? 0 }},
                    gvwr: {{ old('oem_gvwr') ?? $vehicle->oem_gvwr ?? 0 }},
                    weight_of_options: {{ old('weight_of_options') ?? $vehicle->weight_of_options ?? 0 }},


                },
                computed: {
                    fuel_weight: function() {
                        let amountUsed = this.fuelLevel / 100; // to get percentage
                        let amountLeft = this.tankSize * (1 - amountUsed ); // number of liters remaining

                        let fuelStr = this.fuelType;
                        fuelStr = fuelStr.toUpperCase();

                        let factor = 0;
                        // search the fuel string for GAS to use a gasoline calculation
                        if ( fuelStr.includes('GAS'))
                        {
                            factor = 1.63786;
                        }
                        //search the fuel string for DIE to use a diesel calculation
                        if ( fuelStr.includes('DIE'))
                        {
                            factor = 1.83425;
                        }

                        let fuelWeight = amountLeft * factor; // get weight of gas in lb
                        return fuelWeight / 2; // going to get split between two tires.
                    },

                    /*
                            flat fueled
                     */

                    base_fueled_weight_rf: function() {
                  //      return Math.round( this.base_weight_rf + this.fuel_weight ) ;
                        return this.base_weight_rf;
                    },
                    base_fueled_weight_lf: function() {
                  //      return Math.round( this.base_weight_lf + this.fuel_weight ) ;
                        return this.base_weight_lf;
                    },
                    base_fueled_weight_lr: function() {
                        return Math.round( this.base_weight_lr + this.fuel_weight ) ;
                    },
                    base_fueled_weight_rr: function() {
                        return Math.round( this.base_weight_rr + this.fuel_weight ) ;
                    },




                    base_raised_fueled_weight_rf: function() {
                        // return Math.round(  this.base_raised_weight_rf + this.fuel_weight );
                        return this.base_raised_weight_rf;
                    },
                    base_raised_fueled_weight_lf: function() {
                     //   return Math.round(  this.base_raised_weight_lf + this.fuel_weight );
                        return this.base_raised_weight_lf;
                    },
                    base_raised_fueled_weight_rr: function() {
                        return Math.round(  this.base_raised_weight_rr + this.fuel_weight );
                    },
                    base_raised_fueled_weight_lr: function() {
                        return Math.round(  this.base_raised_weight_lr + this.fuel_weight );
                    },



                    // summaries
                    front_axel_weight_with_fuel: function() {
                        return Math.round(  this.base_weight_rf + this.base_weight_lf );
                    },
                    rear_axel_weight_with_fuel: function() {
                        return Math.round(  this.base_fueled_weight_lr + this.base_fueled_weight_rr );
                    },
                    total_weight: function() {
                        return Math.round(  this.rear_axel_weight_with_fuel + this.front_axel_weight_with_fuel  );
                    },
                    payload: function() {
                        return Math.round(  this.gvwr - this.total_weight );
                    },



                }
            });
        </script>
        <script>

       //     selectElement('leaveCode', '11')

            function selectElement(id, valueToSelect) {
                let element = document.getElementById(id);
                element.value = valueToSelect;
            }

            function clearForm()
            {
                vue.base_weight_lf = 0;
                vue.base_weight_lr = 0;
                vue.base_weight_rf = 0;
                vue.base_weight_rr = 0;
                vue.base_raised_weight_lf = 0;
                vue.base_raised_weight_lr = 0;
                vue.base_raised_weight_rf = 0;
                vue.base_raised_weight_rr = 0;

                vue.base_fueled_weight_lf = 0;
                vue.base_fueled_weight_lr = 0;
                vue.base_fueled_weight_rf = 0;
                vue.base_fueled_weight_rr = 0;
                vue.base_raised_fueled_weight_lf = 0;
                vue.base_raised_fueled_weight_lr = 0;
                vue.base_raised_fueled_weight_rf = 0;
                vue.base_raised_fueled_weight_rr = 0;

                vue.fuelType = "";
                vue.tankSize = 0;
                vue.fuelLevel = 0;
                vue.gvwr = 0;


                let elements = document.querySelectorAll('#regulatory_form input');
                for (let i = 0; i < elements.length; i++)
                {
                    if ( elements[i].type === 'checkbox')
                    {
                        elements[i].checked = false;
                   //     elements[i].value
                    }
                    else
                    {
                        elements[i].value = "";
                    }
                }

                let selects = document.querySelectorAll('#regulatory_form select');
                for (let i = 0; i < selects.length; i++)
                {
         //           selectElement(selects[i], "0");
             //       selectElement(selects[i].id, "0");
                    selects[i].value = "0";
                }
            }

            function fillFields( obj )
            {

                clearForm();
                //alert( document.getElementById("driver_seat_1_used").type );

                vue.fuelType = obj.fuel;
                vue.tankSize = obj.tank_volume;
                vue.fuelLevel = 37;
                vue.gvwr = obj.oem_gvwr;

                Object.keys( obj ).forEach( function (key) {

                    let field = document.getElementById(key);
                    if (field)
                    {
                        if (field.type === "select-one")
                        {
                          //  selectElement(selects[i].id, "1");
         //                   console.log( field,  key, obj[key])
                            selectElement(key, obj[key])
                        } else {
                            field.value = obj[key]}
                        }
                    }

                );


            }


function transitConnectMobility()
{
	 let vals = {
               manufacturer_code: "MPV/VTUM",
               fuel: 'GAS',
               tire_size: '215/55R16 XL 97H',
               wheel_size: '16 x 6.5J',
               tire_diameter: "25.3",
               front_tread_width: "61.4",
               rear_tread_width: "61.7",
               front_tire_pressure: 41,
               rear_tire_pressure: 42,
               spare_tire_pressure: 42,
               wheelbase: 121,
               oem_gvwr: 5302,
               oem_front_gawr: 2700,
               oem_rear_gawr: 2875,

               //cab_seat_1_axel: 40,
             //  cab_seat_1_wheel: 52.5,
               cab_seat_1_used: 1,
               cab_seat_1_desc: "DRIVER",

           //    cab_seat_2_axel: 40,
         //      cab_seat_2_wheel: 19,
               cab_seat_2_used: 1,
               cab_seat_2_desc: "PASSENGER CAB",


               tank_volume: 60,
	};


           fillFields( vals );

}



       function transit2020mobility()
       {
           let vals = {
       //        ambulance_model: "V148FG",
         //      ambulance_type: "Type II",
               manufacturer_code: "MPV/VTUM",
        //       alternator_amperage: 230,
               fuel: 'GAS',
               tire_size: '235/65R16C',
               wheel_size: '16 x 6.5J',
               tire_diameter: "29",
               front_tread_width: "68.2",
               rear_tread_width: "68.6",
               front_tire_pressure: 57,
               rear_tire_pressure: 75,
               spare_tire_pressure: 75,
               wheelbase: 148,
               oem_gvwr: 9070,
               oem_front_gawr: 4360,
               oem_rear_gawr: 5515,

               cab_seat_1_axel: 40,
               cab_seat_1_wheel: 52.5,
               cab_seat_1_used: 1,
               cab_seat_1_desc: "DRIVER",

               cab_seat_2_axel: 40,
               cab_seat_2_wheel: 19,
               cab_seat_2_used: 1,
               cab_seat_2_desc: "PASSENGER CAB",


               tank_volume: 95,
           }
           fillFields( vals );
       }





       function transit2020amb()
            {
                let vals = {
                    ambulance_model: "V148FG",
                    ambulance_type: "Type II",
                    manufacturer_code: "AMB",
                    alternator_amperage: 250,
                    fuel: 'GAS',
                    tire_size: '235/65R16C',
                    wheel_size: '16 x 6.5J',
                    tire_diameter: "29",
                    front_tread_width: "68.2",
                    rear_tread_width: "68.6",
                    front_tire_pressure: 57,
                    rear_tire_pressure: 75,
                    spare_tire_pressure: 75,
                    wheelbase: 148,
                    oem_gvwr: 9070,
                    oem_front_gawr: 4360,
                    oem_rear_gawr: 5515,

                    cab_seat_1_axel: 40,
                    cab_seat_1_wheel: 52.5,
                    cab_seat_1_used: 1,
                    cab_seat_1_desc: "DRIVER",

                    cab_seat_2_axel: 40,
                    cab_seat_2_wheel: 19,
                    cab_seat_2_used: 1,
                    cab_seat_2_desc: "PASSENGER CAB",

                    passenger_seat_1_axel: 93,
                    passenger_seat_1_wheel: 58,
                    passenger_seat_1_used: 1,
                    passenger_seat_1_desc: "ATTENDANT",

                    passenger_seat_2_axel: 122,
                    passenger_seat_2_wheel: 9,
                    passenger_seat_2_used: 1,
                    passenger_seat_2_desc: "SQUADBENCH",

                    passenger_seat_3_axel: 137,
                    passenger_seat_3_wheel: 9,
                    passenger_seat_3_desc: "SQUADBENCH",

                    passenger_seat_4_axel: 132,
                    passenger_seat_4_wheel: 17,
                    passenger_seat_4_desc: "PRIMARY CARE",
                    passenger_seat_4_used: 1,

                    tank_volume: 95,
                }
                fillFields( vals );
            }







       function transit2020ambAWD()
       {
           let vals = {
               ambulance_model: "V148FG",
               ambulance_type: "Type II",
               manufacturer_code: "AMB",
               alternator_amperage: 250,
               fuel: 'GAS',
               tire_size: '235/65R16C',
               wheel_size: '16 x 6.5J',
               tire_diameter: "29",
               front_tread_width: "68.2",
               rear_tread_width: "68.6",
               front_tire_pressure: 57,
               rear_tire_pressure: 75,
               spare_tire_pressure: 75,
               wheelbase: 148,
               oem_gvwr: 9070,
               oem_front_gawr: 4630,
               oem_rear_gawr: 5515,

               cab_seat_1_axel: 40,
               cab_seat_1_wheel: 52.5,
               cab_seat_1_used: 1,
               cab_seat_1_desc: "DRIVER",

               cab_seat_2_axel: 40,
               cab_seat_2_wheel: 19,
               cab_seat_2_used: 1,
               cab_seat_2_desc: "PASSENGER CAB",

               passenger_seat_1_axel: 93,
               passenger_seat_1_wheel: 58,
               passenger_seat_1_used: 1,
               passenger_seat_1_desc: "ATTENDANT",

               passenger_seat_2_axel: 122,
               passenger_seat_2_wheel: 9,
               passenger_seat_2_used: 1,
               passenger_seat_2_desc: "SQUADBENCH",

               passenger_seat_3_axel: 137,
               passenger_seat_3_wheel: 9,
               passenger_seat_3_desc: "SQUADBENCH",

               passenger_seat_4_axel: 132,
               passenger_seat_4_wheel: 17,
               passenger_seat_4_desc: "PRIMARY CARE",
               passenger_seat_4_used: 1,

               tank_volume: 95,
           }
           fillFields( vals );
       }








       function transit2020ambRWD()
       {
           let vals = {
               ambulance_model: "V148FG",
               ambulance_type: "Type II",
               manufacturer_code: "AMB",
               alternator_amperage: 250,
               fuel: 'GAS',
               tire_size: '235/65R16C',
               wheel_size: '16 x 6.5J',
               tire_diameter: "29",
               front_tread_width: "68.2",
               rear_tread_width: "68.6",
               front_tire_pressure: 52,
               rear_tire_pressure: 75,
               spare_tire_pressure: 75,
               wheelbase: 148,
               oem_gvwr: 9070,
               oem_front_gawr: 4130,
               oem_rear_gawr: 5515,

               cab_seat_1_axel: 40,
               cab_seat_1_wheel: 52.5,
               cab_seat_1_used: 1,
               cab_seat_1_desc: "DRIVER",

               cab_seat_2_axel: 40,
               cab_seat_2_wheel: 19,
               cab_seat_2_used: 1,
               cab_seat_2_desc: "PASSENGER CAB",

               passenger_seat_1_axel: 93,
               passenger_seat_1_wheel: 58,
               passenger_seat_1_used: 1,
               passenger_seat_1_desc: "ATTENDANT",

               passenger_seat_2_axel: 122,
               passenger_seat_2_wheel: 9,
               passenger_seat_2_used: 1,
               passenger_seat_2_desc: "SQUADBENCH",

               passenger_seat_3_axel: 137,
               passenger_seat_3_wheel: 9,
               passenger_seat_3_desc: "SQUADBENCH",

               passenger_seat_4_axel: 132,
               passenger_seat_4_wheel: 17,
               passenger_seat_4_desc: "PRIMARY CARE",
               passenger_seat_4_used: 1,

               tank_volume: 95,
           }
           fillFields( vals );
       }










       function transit2019amb()
       {
           let vals = {
               ambulance_model: "V148FG",
               ambulance_type: "Type II",
               manufacturer_code: "AMB",
               alternator_amperage: 250,
               fuel: 'GAS',
               tire_size: '235/65R16C',
               wheel_size: '16 x 6.5J',
               tire_diameter: "29",
               front_tread_width: "68.2",
               rear_tread_width: "68.6",
               front_tire_pressure: 52,
               rear_tire_pressure: 71,
               spare_tire_pressure: 71,
               wheelbase: 148,
               oem_gvwr: 9000,
               oem_front_gawr: 4130,
               oem_rear_gawr: 5515,

               cab_seat_1_axel: 40,
               cab_seat_1_wheel: 52.5,
               cab_seat_1_used: 1,
               cab_seat_1_desc: "DRIVER",

               cab_seat_2_axel: 40,
               cab_seat_2_wheel: 19,
               cab_seat_2_used: 1,
               cab_seat_2_desc: "PASSENGER CAB",

               passenger_seat_1_axel: 93,
               passenger_seat_1_wheel: 58,
               passenger_seat_1_used: 1,
               passenger_seat_1_desc: "ATTENDANT",

               passenger_seat_2_axel: 122,
               passenger_seat_2_wheel: 9,
               passenger_seat_2_used: 1,
               passenger_seat_2_desc: "SQUADBENCH",

               passenger_seat_3_axel: 137,
               passenger_seat_3_wheel: 9,
               passenger_seat_3_desc: "SQUADBENCH",

               passenger_seat_4_axel: 132,
               passenger_seat_4_wheel: 17,
               passenger_seat_4_desc: "PRIMARY CARE",
               passenger_seat_4_used: 1,


               tank_volume: 95,
           }
           fillFields( vals );
       }







            @include('vehicles::info.templates.promaster_2019_ambulance')
            @include('vehicles::info.templates.promaster_2020_ambulance')


        </script>
@endsection

