
<canvas
    id='door'


    width="432"
    height="144"
    style='padding:10px;
    height: 1in;
    /*width: 5in;*/
    border:  1px solid #cd58ff;'>

</canvas>

    <script>


            let door_canvas = document.getElementById('door');


            let door = door_canvas.getContext('2d');

            door.font = '20px sans-serif';
            door.textAlign = 'right';
            door.textBaseline = 'top'


            door.strokeStyle = 'black';
            door.lineWidth = 3 ;

            door.strokeRect(
                2,
                2,
                430,
                125);




            door.drawImage( logo, 10 , 10 );

            door.fillText("{{ $vehicle->identifier ?? "xxxxxx" }}", 420, 18);

            door.textAlign = 'left';
            door.font = '12pt sans-serif';

            door.fillText(`FOR MALLEY SERVICE, CALL     1 (877) 859-8591`, 10, 50);
            door.fillText(`FOR WARRANTY CLAIMS, VISIT:`, 10, 80);
            door.fillText(`blueprint.malleyindustries.com/warranty `, 20, 100);


</script>
