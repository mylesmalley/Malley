
<canvas
    id='caas'


    width="384"
    height="288"
    style='padding:10px;
    margin: 40px;
    height: 1in;
    width: 2in;
    /*width: 2in;*/
 '>

</canvas>

<script>


    let cass_canvas = document.getElementById('caas');


    let caas = cass_canvas.getContext('2d');

    caas.font = '25px sans-serif';
    caas.textAlign = 'left';
    caas.textBaseline = 'bottom';

    let caasline = 49;

    caas.fillText("{{ $vehicle->year }} {{ $vehicle->make }} {{ strtoupper( $vehicle->model ) }}", 0, caasline );//x: 206 y: 154
    caas.fillText("{{ $vehicle->vin ?? "XXXXXXXXXXXXXXX"  }}", 0, caasline * 2);//x: 206 y: 154
    caas.fillText("{{ $vehicle->ambulance_type }} {{ $vehicle->malley_number ?? "XXXXXXXXXXXXXXX"  }}", 0, caasline * 3);//x: 206 y: 154
    caas.fillText("{{ $vehicle->milestone('chassis_manufactured') ?? "DATE_FINISHED" }}", 0, caasline * 4);//x: 206 y: 154
    caas.fillText("{{ $vehicle->payload ?? "XXXXXXXXXXXXXXX" }}", 0, caasline * 5);//x: 206 y: 154
    caas.fillText("Y", 0, caasline * 6);//x: 206 y: 154
</script>
