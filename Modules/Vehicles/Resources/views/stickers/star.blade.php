{{--@extends('vehicles::layout')--}}

{{--@section('content')--}}
<canvas
    id='star'


    width="2500"
    height="2600"
    style='padding:10px;border: 1px solid blue;
    width:7.8in;'
></canvas>

{{--@endsection--}}

{{--@section('scripts')--}}
<script>

    let newstar = document.getElementById('star');
    let star = newstar.getContext('2d');

    star.strokeStyle = 'black';

    star.lineWidth = 9;

    star.strokeRect(
        15,
        15,
        1220,
        520  );




    // START OF OXYGEN TEST SECTION


    //HEADLINE TEXT
    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("AMBULANCE MAIN OXYGEN SYSTEM TEST", 625, 25);


    star.font = ' 36px sans-serif';
    star.textBaseline = 'top'
  //  star.textAlign = 'left';
    star.fillStyle = 'black';

    // for ( let i = 1; i < 40; i++)
    // {
    //     star.fillText(`${i}`, 1250, 51 + (i * 36));
    //
    // }
    //
    // for ( let j = 1; j < 100; j+=2)
    // {
    //     star.fillText(`${j*4}`, (j * 100),100);
    //
    // }

    function line( line )
    {
        return ( line * 36) + 51;
    }
    function col( col )
    {
        return ( col * 25) ;
    }


    function write( line )
    {
        return ( line * 36) + 51;
    }


    star.fillText(`This vehicle has been tested and is certified to be in compliance with the`, 625,  line(1));
    star.fillText(`oxygen system proof pressure and leakage requirements of AMD `, 625,  line(2));
    star.fillText(`Standard 015, Ambulance Main Oxygen System Test`, 625,  line(3));
    //// blank
    //  star.textAlign = 'left';
    star.font = ' bold 36px sans-serif';
    star.fillText(`Initial Conditions`, 320,  line(5));
    star.fillText(`Final Conditions`, 930,  line(5));
    star.font = ' 36px sans-serif';
    //// blank

     star.textAlign = 'right';
    star.fillText(`Temperature __________ °F`, 560,  line(7));
    star.fillText(`{{ round( ( $vehicle->o2_test_temperature * 1.8) + 32 )  }}`, 450,  line(7));
    star.fillText(`Pressure __________ psi`, 560,  line(8));
    star.fillText(`{{ round( $vehicle->os_test_start_pressure )  }}`, 450,  line(8));

    star.fillText(`Temperature __________ °F`, 1150,  line(7));
    star.fillText(`{{ round( ( $vehicle->o2_test_temperature * 1.8) + 32 )  }}`, 1025,  line(7));
    star.fillText(`Pressure __________ psi`, 1150,  line(8));
    star.fillText(`{{ round( $vehicle->os_test_final_pressure )  }}`, 1025,  line(8));


    star.textAlign = 'center';
    star.fillText(`Max Allowable Pressure Loss 5 psi   Pressure Loss _______ psi`, 625,  line(9));
    star.textAlign = 'right';
    star.fillText(`{{ round( $vehicle->os_test_final_pressure - $vehicle->os_test_start_pressure, 1 ) }}`, 1025,  line(9));

    star.textAlign = 'left';

    star.fillText(`Date`, 50,  line(11));
    star.fillText(`of Test ____________`, 50,  line(12));
    star.fillText(`{{ $vehicle->milestone('o2_test') ?? "O2_TEST" }}`, 200,  line(12));

    star.fillText(`Authorized Ambulance `, 410,  line(11));
    star.fillText(`Manufacturer Representative ________________`, 410,  line(12));


    // E N D  O F  O X Y G E N  S E C T I O N



    star.strokeRect(
        15,
        580,
        1220,
        1250  );

    //HEADLINE TEXT
    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("WEIGHT / PAYLOAD CERTIFICATION STICKER NOTICE", 625, line(15));

    // top text paragrap
    star.font = ' 36px sans-serif';
    star.textBaseline = 'top'
    //  star.textAlign = 'left';
    star.fillStyle = 'black';

    star.fillText(`This vehicle, as manufactured, conforms to the payload requirements of `, 625,  line(17));
    star.fillText(`the Federal Ambulance Specification KKK-A-1822. Users shall not load `, 625,  line(18));
    star.fillText(`vehicles above the GVWR. Users should determine that the actual load, to `, 625,  line(19));
    star.fillText(`be placed on the vehicle does not exceed the usable payload. `, 625,  line(20));

    star.font = ' 28px sans-serif';

    star.fillText(`_____________________________________________`, 625,  line(22));
    star.fillText(`AMBULANCE MANUFACTURER'S NAME. `, 625,  line(23));


    star.fillText(`_________________________________              _____________    `   , 625,  line(25));
    star.fillText(`           CHASSIS MODEL.                               YEAR OF MANUFACTURE `, 625,  line(25.9));



    star.font = 'bold 36px sans-serif';
    star.fillText(`MALLEY INDUSTRIES INC.`, 625,  line(21.9));
    star.fillText(`      {{ $vehicle->make }} {{ $vehicle->model }}                              `, 625,  line(24.9));
    star.fillText(`     {{ $vehicle->year }}    `, 900,  line(24.9));


    // LIST
    star.textAlign = 'left';

    star.font = ' 36px sans-serif';
    star.fillText(`1.`, 40,  line(28));
    star.fillText(`VEHICLE TYPE, MODEL, PROD #`, 80,  line(28));
    star.fillText(`_________________________`, 700,  line(28));
    star.fillText(`{{ $vehicle->ambulance_type }} | {{ $vehicle->ambulance_model }} | {{ $vehicle->malley_number }}`, 750,  line(28));


    star.fillText(`2.`, 40,  line(29));
    star.fillText(`CHASSIS MANUFACTURER GAWR-FRONT`, 80,  line(29));
    star.fillText(`____________LB`, 900,  line(29));
    star.fillText(`{{ $vehicle->oem_front_gawr }}`, 950,  line(29));



    star.fillText(`3.`, 40,  line(30));
    star.fillText(`CHASSIS MANUFACTURER GAWR-REAR`, 80,  line(30));
    star.fillText(`____________LB`, 900,  line(30));
    star.fillText(`{{ $vehicle->oem_rear_gawr }}`, 950,  line(30));



    star.fillText(`4.`, 40,  line(31));
    star.fillText(`CHASSIS MANUFACTURER GVWR`, 80,  line(31));
    star.fillText(`____________LB`, 900,  line(31));
    star.fillText(`{{ $vehicle->oem_gvwr }}`, 950,  line(31));

    star.fillText(`5.`, 40,  line(32));
    star.fillText(`MINIMUM PAYLOAD PER KKK-A-1822`, 80,  line(32));
    star.fillText(`OR AS SPECIFIED (PARA 3.5.2)`, 110,  line(33));
    star.fillText(`____________LB`, 900,  line(33));
    star.fillText(`1500`, 950,  line(33));


    star.fillText(`6.`, 40,  line(34));
    star.fillText(`CURB WEIGHT-FRONT BASE VEHICLE`, 80,  line(34));
    star.fillText(`____________LB`, 900,  line(34));
    star.fillText(`{{ $vehicle->front_axel_weight_with_fuel }}`, 950,  line(34));


    star.fillText(`7.`, 40,  line(35));
    star.fillText(`CURB WEIGHT-REAR BASE VEHICLE`, 80,  line(35));
    star.fillText(`____________LB`, 900,  line(35));
    star.fillText(`{{ $vehicle->rear_axel_weight_with_fuel }}`, 950,  line(35));

    star.fillText(`8.`, 40,  line(36));
    star.fillText(`CURB WEIGHT BASE VEHICLE`, 80,  line(36));
    star.fillText(`(ITEM 6 PLUS ITEM 7) (PARA 3.5.1)`, 110,  line(37));
    star.fillText(`____________LB`, 900,  line(37));
    star.fillText(`{{ $vehicle->total_weight }}`, 950,  line(37));


    star.fillText(`9.`, 40,  line(38));
    star.fillText(`PAYLOAD OF BASIC VEHICLE`, 80,  line(38));
    star.fillText(`(ITEM 4 MINUS ITEM 8)`, 110,  line(39));
    star.fillText(`MUST MEET OR EXCEED ITEM 5`, 110,  line(40));
    star.fillText(`____________LB`, 900,  line(40));
    star.fillText(`{{ $vehicle->payload }}`, 950,  line(40));



    star.fillText(`10.`, 33,  line(41));
    star.fillText(`PAYLOAD OF FRONT AXEL `, 80,  line(41));
    star.fillText(`(ITEM 2 MINUS ITEM 6)`, 110,  line(42));
    star.fillText(`____________LB`, 900,  line(42));
    star.fillText(`{{ $vehicle->oem_front_gawr - $vehicle->front_axel_weight_with_fuel }}`, 950,  line(42));

    {{--star.fillText(`11.`, 33,  line(43));--}}
    {{--star.fillText(`REMAINING USABLE PAYLOAD`, 80,  line(43));--}}
    {{--star.fillText(`(ACTUAL WEIGHT USER MAY ADD)`, 110,  line(44));--}}
    {{--star.fillText(`(ITEM 9 MINUS ITEM 10)`, 110,  line(45));--}}
    {{--star.fillText(`____________LB`, 900,  line(45));--}}
    {{--star.fillText(`{{ $vehicle->payload }}`, 950,  line(45));--}}

    // FOOTER

    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("THIS STICKER SHALL BE MOUNTED ON THE BODY (MODULE)", 625, line(45));
    star.fillText("IN A CONSPICUOUS LOCATION", 625, line(46));

    star.font = '36px sans-serif';



    // STAR OF LIFE STICKER START

    star.strokeRect(
        15,
        1875,
        1220,
        670  );

    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText(`CERTIFIED "STAR OF LIFE" AMBULANCE`, 625, line(51));

    star.font = '36px sans-serif';
    star.textAlign = 'left';
    star.fillText(`Manufacturer _________________`, 40, line(53));
    star.fillText(`Malley Industries Inc`, 270, line(53));

    star.fillText(`Date of Manufacture ___________`, 650, line(53));
    star.fillText(`{{ $vehicle->milestone('completed') ?? date("Y-m-d") }}`, 1000, line(53));

    star.fillText(`Address _________________ City ________ State _____ ZIP ________`, 40, line(54));
    star.fillText(`1100 Aviation Ave`, 200, line(54));
    star.fillText(`Dieppe`, 625, line(54));
    star.fillText(`NB`, 900, line(54));
    star.fillText(`E1A9A3`, 1050, line(54));


    star.fillText(`This ambulance conforms to Federal Specification KKK-A-1822 in effect`, 40, line(55));
    star.fillText(`on the date the ambulance was contracted for.`, 40, line(56));
    star.fillText(`Final State Ambulance Manufacturers ID Number ___________________`, 40, line(57));
    star.fillText(`68823`, 900, line(57));



    star.fillText(`VIN __________________________ Vehicle Type __________________`, 40, line(58));
    star.fillText(`{{ $vehicle->vin }}`, 180, line(58));
    star.fillText(`{{ $vehicle->ambulance_type }}`, 900, line(58));


    star.fillText(`OEM Chassis Model / Year of Manufacture ________________________`, 40, line(59));
    star.fillText(`{{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->year }}`, 740, line(59));



    star.font = '36px sans-serif';
    star.textAlign = 'center';

    star.fillText(`NOTICE: THIS VEHICLE, AS MANUFACTURERD, CONFORMS TO`, 625, line(61));
    star.fillText(`THE PAYLOAD REQUIREMENTS OF THE FEDERAL AMBULANCE`, 625, line(62));
    star.fillText(`SPECIFICATION KKK-A-1822. USERS SHALL NOT LOAD VEHICLES`, 625, line(63));
    star.fillText(`ABOVE THE GVWR, GAWRs OR EXCEED THE TOTAL USABLE `, 625, line(64));
    star.fillText(`PAYLOAD LISTED BELOW.`, 625, line(65));

    star.fillText(`TOTAL USABLE PAYLOAD_______________________________LB`, 625, line(67));
    star.fillText(`{{ $vehicle->payload  }}`, 800, line(67));
    star.font = '24px sans-serif';
    star.fillText(`(TOTAL REMAINING WEIGHT CAPACITY OF OCCUPANTS AND CARGO USER MAY ADD)`, 625, line(68));














    star.strokeRect(
        1265,
        15,
        1220,
        1850);


    star.font = 'bold 36px sans-serif';
    star.textBaseline = 'top'
    star.textAlign = 'center';
    star.fillStyle = 'black';

    star.fillText("ELECTRICAL LOAD TEST CERTIFICATION AND AMD 005", 1850, 25);


    star.font = ' 36px sans-serif';
    //  star.textAlign = 'left';
    star.fillStyle = 'black';

    star.textAlign = 'left';

    star.fillText(`A`, col(52), line(1));
    star.fillText(`The data herein is based upon turning on the following electrical`,col(54), line(1));
    star.fillText(`electrical equipment and electrical load(s) simultaneously.`,col(54), line(2));

    star.fillText(`1`, col(53), line(3));
    star.fillText(`Ignition system`,col(56), line(3));

    star.fillText(`2`, col(53), line(4));
    star.fillText(`Headlights (low beam) and all CMVSS / FMVSS lighting`,col(56), line(4));

    star.fillText(`3`, col(53), line(5));
    star.fillText(`Windshield wipers (low speed)`,col(56), line(5));

    star.fillText(`4`, col(53), line(6));
    star.fillText(`Cab air conditioning (at coldest setting with highest)`,col(56), line(6));
    star.fillText(`blower speed)`,col(56), line(7));

    star.fillText(`5`, col(53), line(8));
    star.fillText(`Radio in receiving mode (or equal load if not equipped - 5A)`,col(56), line(8));

    star.fillText(`6`, col(53), line(9));
    star.fillText(`Patient module dome lighting (high intensity setting)`,col(56), line(9));

    star.fillText(`7`, col(53), line(10));
    star.fillText(`Patient module air conditioning (at coldest setting with`,col(56), line(10));
    star.fillText(`highest blower speed)`,col(56), line(11));

    star.fillText(`8`, col(53), line(12));
    star.fillText(`Emergency warning lighting system in`,col(56), line(12));
    star.fillText(`"clear-right-of-way-mode (3.8.2)`,col(56), line(13));

    star.fillText(`9`, col(53), line(14));
    star.fillText(`20 amp medical load or equivalent`,col(56), line(`14`));

    star.fillText(`10`, col(53), line(15));
    star.fillText(`Left and right side flood lights`,col(56), line(15));

    star.fillText(`11`, col(53), line(16));
    star.fillText(`Rear flood lights`,col(56), line(16));

    star.fillText(`12`, col(53), line(17));
    star.fillText(`Optional 12 volt DC equipment and lights`,col(56), line(17));


    star.fillText(`This vehicle  X  is / __ is not equipped with a load management system. `, col(52), line(19));

    star.fillText(`NOTE: If equipped with an electrical load management system, certain`, col(52), line(21));
    star.fillText(`loads / functions listed above may have been inhibited automatically from`, col(52), line(22));
    star.fillText(`operating by the load management system during testing. If equipped `, col(52), line(23));
    star.fillText(`with an accessible electrical load management override switch, the`, col(52), line(24));
    star.fillText(`switch was activated during testing to provide the maximum attainable`, col(52), line(25));
    star.fillText(`electrical load.`, col(52), line(26));




    star.fillText(`B`, col(52), line(28));
    star.fillText(`Name of ambulance manufacturer`,col(54), line(28));
    star.fillText(`________________________`, col(78), line(28));
    star.fillText(`Malley Industries Inc.`, col(80), line(28));

    star.fillText(`C`, col(52), line(29));
    star.fillText(`Ambulance type / model`,col(54), line(29));
    star.fillText(`________________________`, col(78), line(29));
    star.fillText(`{{ $vehicle->ambulance_type }} | {{ $vehicle->model }}`, col(80), line(29));

    star.fillText(`D`, col(52), line(30));
    star.fillText(`Chassis manufacturer`,col(54), line(30));
    star.fillText(`________________________`, col(78), line(30));
    star.fillText(`{{ $vehicle->make }}`, col(80), line(30));

    star.fillText(`E`, col(52), line(31));
    star.fillText(`Vehicle Identification Number`,col(54), line(31));
    star.fillText(`________________________`, col(78), line(31));
    star.fillText(`{{ $vehicle->vin }}`, col(80), line(31));

    star.fillText(`F`, col(52), line(32));
    star.fillText(`Electrical Generating System Data`,col(54), line(32));

    star.fillText(`1`, col(53), line(33));
    star.fillText(`Alternator make / model`,col(56), line(33));
    star.fillText(`________________________`, col(78), line(33));
    star.fillText(`OEM`, col(80), line(33));

    star.fillText(`2`, col(53), line(34));
    star.fillText(`Maximum 12 volt DC manufacturer's current `, col(56), line(34));
    star.fillText(`rating at 200 F (93 C) at 14 volt DC`,col(56), line(35));
    star.fillText(`_______`, col(89.5), line(35));
    star.fillText(`Amp`, col(95), line(35));
    star.fillText(`{{ $vehicle->alternator_amperage}}`, col(90.5), line(35));


    star.fillText(`G`, col(52), line(36));
    star.fillText(`Test Data`,col(54), line(36));

        star.fillText(`1`, col(53), line(37));
        star.fillText(`Lowest DC voltage at common point with loads 1-11`,col(56), line(37));
        star.fillText(`_______`, col(89.5), line(37));
        star.fillText(`Volt`, col(95), line(37));
        star.fillText(`{{ round( $vehicle->load_test_1_lowest ,1) }}`, col(90.5), line(37));

       star.fillText(`2`, col(53), line(38));
        star.fillText(`Lowest DC voltage at common point with loads 1-12`,col(56), line(38));
        star.fillText(`_______`, col(89.5), line(38));
        star.fillText(`Volt`, col(95), line(38));
        star.fillText(`{{ round( $vehicle->load_test_2_lowest, 1)}}`, col(90.5), line(38));

        star.fillText(`3`, col(53), line(39));
        star.fillText(`Engine Speed Setting`,col(56), line(39));
        star.fillText(`_______`, col(89.5), line(39));
        star.fillText(`RPM`, col(95), line(39));
        star.fillText(`1500`, col(90.5), line(39));


    star.fillText(`4`, col(53), line(40));
    star.fillText(`DC current draw at common point with loads 1-11`,col(56), line(40));
    star.fillText(`_______`, col(89.5), line(40));
    star.fillText(`Amp`, col(95), line(40));
    star.fillText(`{{ round( $vehicle->load_test_1_highest,1 ) }}`, col(90.5), line(40));



    star.fillText(`5`, col(53), line(41));
    star.fillText(`DC current draw at common point with loads 1-12`,col(56), line(41));
    star.fillText(`without load management system`,col(56), line(42));
    star.fillText(`_______`, col(89.5), line(42));
    star.fillText(`Amp`, col(95), line(42));
    star.fillText(`{{ round( $vehicle->load_test_2_highest,1 ) }}`, col(90.5), line(42));




    star.fillText(`H`, col(52), line(43));
    star.fillText(`Generating reserve`,col(54), line(43));

        star.fillText(`1`, col(53), line(44));
        star.fillText(`Generating reserve (+) overload (-) with loads 1-11`,col(56), line(44));
        star.fillText(`_______`, col(89.5), line(44));
        star.fillText(`Amp`, col(95), line(44));
        star.fillText(`{{ round(  $vehicle->alternator_amperage -$vehicle->load_test_1_highest  ,1) }}`, col(90.5), line(44));

    star.fillText(`2`, col(53), line(45));
    star.fillText(`Generating reserve (+) overload (-) with loads 1-12`,col(56), line(45));
    star.fillText(`without load management system`,col(56), line(46));
    star.fillText(`_______`, col(89.5), line(46));
    star.fillText(`Amp`, col(95), line(46));
    star.fillText(`{{ round(  $vehicle->alternator_amperage -$vehicle->load_test_2_highest,1 ) }}`, col(90.5), line(46));


    star.fillText(`I`, col(53), line(47));
    star.fillText(`Date of test`,col(56), line(47));
    star.fillText(`________________________`, col(78), line(47));
    star.fillText(`{{$vehicle->milestone('load_test') ?? "LOAD_TEST" }}`, col(80), line(47));


    star.fillText(`J`, col(53), line(48));
    star.fillText(`The electrical system has been tested and is in compliance`,col(56), line(48));
    star.fillText(`with AMD standard 005`,col(56), line(49));


    /**
     * malley info sticker
     */

    star.strokeRect(
        1265,
        1910,
        1220,
        217);

    star.drawImage( bg_logo, col(52) , line(52) );
    star.textAlign = 'right';

    star.fillText(`Malley Industries Inc.`, col(98), line(52));
    star.fillText(`1100 Aviation Avenue`, col(98), line(53));
    star.fillText(`Dieppe, New Brunswick, Canada`, col(98), line(54));
    star.fillText(`E1A 9A3`, col(98), line(55));

    star.textAlign = 'left';
    star.fillText(`Tel: 1 (877) 859-8591`, col(52), line(54));
    star.fillText(`Fax: 1 (877) 857-1745`, col(52), line(55));

    star.textAlign = 'center';
    star.fillText(`www.malleyindustries.com`, 1875, line(56));


</script>
