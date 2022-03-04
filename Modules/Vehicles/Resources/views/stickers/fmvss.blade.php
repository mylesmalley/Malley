{{--@extends('vehicles::layout')--}}

{{--@section('content')--}}
    <canvas
        id='fmvss'
{{--        width='264'--}}
{{--        height='528'--}}

    width="1056"
        height="528"
        style='padding:10px;
        height:225px; width:450px;
'></canvas>

{{--@endsection--}}

{{--@section('scripts')--}}
<script>


    let fmvss = document.getElementById('fmvss');



    const inch = 96;
    // ctx.lineWidth = 2;
    // for ( let i = 0; i < 10; i++)
    // {
    //     // horizontal lines
    //     ctx.moveTo(0, i* inch);
    //     ctx.lineTo(1000, i* inch);
    //
    //     ctx.stroke();
    //     // vertical lines
    //     ctx.moveTo( i* inch, 0);
    //     ctx.lineTo( i* inch, 1000);
    //
    //     ctx.stroke();
    // }

    // ===================================================================== //

    const SCALE_FACTOR = 2;

    const EIGHTH = 0.125 * inch * SCALE_FACTOR;
    const QUARTER = 0.25 * inch * SCALE_FACTOR;
    const HALF = 0.5 * inch * SCALE_FACTOR;

    let fmvss_width = 2.75 * inch * SCALE_FACTOR;
    let fmvss_height = 5.5 * inch * SCALE_FACTOR;
    let fmvss_x = 0;
    let fmvss_y = 0;



        let ctx = fmvss.getContext('2d');
        //
        ctx.translate(fmvss_height, 0);

        ctx.rotate( 90 * Math.PI / 180)
    let cursor = 0;

    let centre = fmvss_width / 2;

    ctx.fillStyle = "yellow";
        ctx.fillRect(0, 0, fmvss_width, fmvss_height );

        //ctx.fillStyle = null;
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 3 * SCALE_FACTOR;
    ctx.strokeRect(
        EIGHTH,
        EIGHTH,
        fmvss_width - QUARTER,
        fmvss_height - QUARTER );


        cursor = 40 * SCALE_FACTOR


    // HEADLINE TEXT
    ctx.font = 'bold 36px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillStyle = 'black';
    ctx.fillText("FMVSS CERTIFICATION", centre, cursor);

        cursor  = 56 * SCALE_FACTOR;


    // stroke under FMVSS Label
    ctx.beginPath();
    ctx.strokeStyle = 'black';
    ctx.lineWidth = 3 * SCALE_FACTOR;
    ctx.moveTo( EIGHTH, cursor );
    ctx.lineTo( fmvss_width - EIGHTH, cursor );
    ctx.stroke();
    ctx.closePath();



    // FMVSS DECLARATION TEXT
    ctx.font = ' 22px sans-serif';
    ctx.textAlign = 'center';
    ctx.fillStyle = 'black';

    let desc = [`This vehicle has been completed in`,
    `accordance with the prior manufacturer's`,
    `IVD, where applicable. This vehicle conforms`,
    `to all applicable U.S.A. Federal Motor Vehicle`,
    `Safety Standards and Bumper and Theft`,
    `Prevention Standards if applicable.`];

    cursor = 70 * SCALE_FACTOR;


    for (let x = 0; x < 6; x++ )
    {
        ctx.fillText( desc[x], centre, 140+ (x*26));
        cursor += 13 * SCALE_FACTOR;
    }


        cursor += 7 * SCALE_FACTOR;

        // date line form

        ctx.textAlign = 'left';
        ctx.fillText( "In effect in:", QUARTER, cursor );
        ctx.save();

        ctx.textAlign = 'right';
        ctx.fillText('MM                    YR', fmvss_width-QUARTER, cursor);


        // date line values
  //      x: 93.33332824707031 y: 131
        ctx.font = 'bold 30px sans-serif';
        ctx.textAlign = 'left';
        ctx.fillText( "{{ date('m') }}", 120 * SCALE_FACTOR, 157 * SCALE_FACTOR );
        ctx.fillText( "{{ date('Y') }}", 174 * SCALE_FACTOR, 157 * SCALE_FACTOR );

        ctx.restore();

        // stroke under FMVSS Label
        // move cursor down
        cursor += 8 * SCALE_FACTOR;

        ctx.beginPath();
        ctx.moveTo( EIGHTH, cursor );
        ctx.lineTo( fmvss_width - EIGHTH, cursor );
        ctx.stroke();
        ctx.closePath();

        cursor += 14 * SCALE_FACTOR;


        ctx.textAlign = 'left';
        ctx.font = '18px sans-serif';
        ctx.fillText( "MANUFACTURED BY", QUARTER, cursor );


        cursor += 9 * SCALE_FACTOR;


        ctx.drawImage( logo, 65 * SCALE_FACTOR, cursor, logo.width  * SCALE_FACTOR, logo.height * SCALE_FACTOR );
        cursor += 32 * SCALE_FACTOR;
        ctx.font = 'bold 24px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = 'black';
        ctx.fillText("MALLEY INDUSTRIES INC.", centre, cursor);

        cursor += 14 * SCALE_FACTOR;

        ctx.beginPath();
        ctx.moveTo( EIGHTH, cursor );
        ctx.lineTo( fmvss_width - EIGHTH, cursor );
        ctx.stroke();
        ctx.closePath();







        cursor += 22 * SCALE_FACTOR;



        // ======================================================= //
        // VEHICLE INFORMATION SECTION
        // ======================================================= //


        ctx.font = 'bold 32px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = 'black';
        ctx.fillText("VEHICLE INFORMATION", centre, cursor);

        cursor += 22 * SCALE_FACTOR;


        ctx.font = ' 22px sans-serif';
        ctx.textAlign = 'left';

        ctx.save();


        /*
         * VIN
         */
        ctx.textAlign = 'left';
        ctx.fillText( "VIN", QUARTER, cursor-4 );
        ctx.textAlign = 'right';
        ctx.fillText( "{{ $vehicle->vin ?? "XXXXXXXXXXXXXXX" }}", fmvss_width - QUARTER, cursor -4 );
        cursor += 16;

        ctx.textAlign = 'left';
        ctx.fillText( "DATE OF ", QUARTER, cursor );

        cursor += 11 * SCALE_FACTOR;

        ctx.textAlign = 'left';
        ctx.fillText( "MANUFACTURE ", QUARTER, cursor );
        ctx.textAlign = 'right';

        // remove day from date
    ctx.fillText( "{{ $vehicle->milestone('chassis_manufactured') ?? "XXXXXXXXXXX" }}", fmvss_width - QUARTER, cursor );

        cursor += 16 * SCALE_FACTOR;


        /*
            MALLEY NUMBER
         */
        ctx.textAlign = 'left';
        ctx.fillText( "MALLEY PRODUCTION #", QUARTER, cursor );
        ctx.textAlign = 'right';
        ctx.fillText( "{{ $vehicle->identifier }}", fmvss_width - QUARTER, cursor );



        cursor += 14 * SCALE_FACTOR;

        ctx.beginPath();
        ctx.moveTo( EIGHTH, cursor );
        ctx.lineTo( fmvss_width - EIGHTH, cursor );
        ctx.stroke();
        ctx.closePath();




        // ======================================================= //
        // TIRE AND PRESSURE SECTION
        // ======================================================= //
        cursor += 22 * SCALE_FACTOR;

        ctx.font = 'bold 32px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = 'black';
        ctx.fillText("WEIGHT / TIRE INFORMATION", centre, cursor);

        cursor += 19 * SCALE_FACTOR;

        ctx.textAlign = 'left';
        ctx.font = 'bold 22px sans-serif';
        ctx.fillText( "GVWR", QUARTER, cursor );
        ctx.font = '22px sans-serif';
        ctx.fillText( "KG", 160 * SCALE_FACTOR, cursor );
        ctx.fillText( "LB", 220 * SCALE_FACTOR, cursor );
        ctx.fillText( "KG", 160 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ round( $vehicle->oem_gvwr * 0.453592 ) }}", 125 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ $vehicle->oem_gvwr }}", 190 * SCALE_FACTOR, cursor );


        cursor += 16 * SCALE_FACTOR;

        ctx.font = 'bold 22px sans-serif';
        ctx.fillText( "GAWR FRONT", QUARTER, cursor );
        ctx.font = '22px sans-serif';
        ctx.fillText( "KG", 160 * SCALE_FACTOR, cursor );
        ctx.fillText( "LB", 220 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ round( $vehicle->oem_front_gawr * 0.453592 ) }}", 125 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ $vehicle->oem_front_gawr }}", 190 * SCALE_FACTOR, cursor );





        cursor += 16 * SCALE_FACTOR;

        ctx.font = '22px sans-serif';
        ctx.fillText( "TIRE", QUARTER, cursor );
        ctx.fillText( "{{ $vehicle->tire_size }}", 60 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ $vehicle->wheel_size }}", 183 * SCALE_FACTOR, cursor );
        ctx.fillText( "RIMS", 145 * SCALE_FACTOR, cursor );

        cursor += 16 * SCALE_FACTOR;

        ctx.font = '22px sans-serif';
        ctx.fillText( "COLD PRESSURE", QUARTER, cursor );
        ctx.fillText( "KPA", 160 * SCALE_FACTOR, cursor );
        ctx.fillText( "PSI", 220 * SCALE_FACTOR, cursor );
        ctx.fillText("{{ round( $vehicle->front_tire_pressure * 6.89476, -1 ) }}", 131 * SCALE_FACTOR, cursor)
        ctx.fillText("{{ round( $vehicle->front_tire_pressure  ) }}", 197 * SCALE_FACTOR, cursor)

        cursor += 16 * SCALE_FACTOR;

        ctx.font = 'bold 22px sans-serif';
        ctx.fillText( "GAWR REAR", QUARTER, cursor );
        ctx.font = '22px sans-serif';
        ctx.fillText( "KG", 160 * SCALE_FACTOR, cursor );
        ctx.fillText( "LB", 220 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ round( $vehicle->oem_rear_gawr * 0.453592 ) }}", 125 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ $vehicle->oem_rear_gawr }}", 190 * SCALE_FACTOR, cursor );

        cursor += 16 * SCALE_FACTOR;

        ctx.font = '22px sans-serif';
        ctx.fillText( "TIRE", QUARTER, cursor );
        ctx.fillText( "{{ $vehicle->tire_size }}", 60 * SCALE_FACTOR, cursor );
        ctx.fillText( "{{ $vehicle->wheel_size }}", 183 * SCALE_FACTOR, cursor );
        ctx.fillText( "RIMS", 145 * SCALE_FACTOR, cursor );

        cursor += 16 * SCALE_FACTOR

        ctx.font = '22px sans-serif';
        ctx.fillText( "COLD PRESSURE", QUARTER, cursor );
        ctx.fillText("{{ round( $vehicle->rear_tire_pressure * 6.89476, -1 ) }}", 131 * SCALE_FACTOR, cursor)
        ctx.fillText( "KPA", 160 * SCALE_FACTOR, cursor );
        ctx.fillText("{{ round( $vehicle->rear_tire_pressure  ) }}", 197 * SCALE_FACTOR, cursor)
        ctx.fillText( "PSI", 220 * SCALE_FACTOR, cursor );

        cursor += 16 * SCALE_FACTOR;



        // stroke under FMVSS Label
        ctx.beginPath();
        ctx.strokeStyle = 'black';
        ctx.lineWidth = 3 * SCALE_FACTOR;
        ctx.moveTo( EIGHTH, cursor );
        ctx.lineTo( fmvss_width - EIGHTH, cursor );
        ctx.stroke();
        ctx.closePath();
        cursor += 22 * SCALE_FACTOR;

        ctx.font = 'bold 32px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillStyle = 'black';
        ctx.fillText("VEHICLE TYPE     {{ $vehicle->manufacturer_code ?? "" }} ", centre, cursor);





</script>


{{--    @endsection--}}
