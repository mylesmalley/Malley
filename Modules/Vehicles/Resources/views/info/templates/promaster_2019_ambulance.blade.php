function promaster2019amb()
{
    let vals = {
        ambulance_model: "V159RG",
        ambulance_type: "Type II",
        manufacturer_code: "AMB",
        alternator_amperage: 220,
        fuel: 'GAS',
        tank_volume: 91,
        tire_size: 'LT225/75R16E',
        wheel_size: '16 x 6',
        tire_diameter: "28",
        front_tread_width: "71.3",
        rear_tread_width: "70.5",
        front_tire_pressure: 65,
        rear_tire_pressure: 80,
        spare_tire_pressure: 80,
        wheelbase: 159,
        oem_gvwr: 9350,
        oem_front_gawr: 4629,
        oem_rear_gawr: 5291,

        cab_seat_1_axel: 40,
        cab_seat_1_wheel: 52.5,
        cab_seat_1_used: 1,
        cab_seat_1_desc: "PASSENGER",
        cab_seat_2_axel: 40,
        cab_seat_2_wheel: 19,
        cab_seat_2_used: 1,
        cab_seat_2_desc: "DRIVER",

        passenger_seat_1_axel: 93,
        passenger_seat_1_wheel: 46.5,
        passenger_seat_1_used: 1,
        passenger_seat_1_desc: "ATTENDANT",

        passenger_seat_2_axel: 122,
        passenger_seat_2_wheel: 9,
        passenger_seat_2_used: 1,
        passenger_seat_2_desc: "SQUADBENCH",

        passenger_seat_3_axel: 145,
        passenger_seat_3_wheel: 9,
        passenger_seat_3_used: 0,
        passenger_seat_3_desc: "SQUADBENCH",

        passenger_seat_4_used: 1,
        passenger_seat_4_axel: 137,
        passenger_seat_4_wheel: 15,
        passenger_seat_4_desc: "PRIMARY CARE",
    }
    fillFields( vals );
}
