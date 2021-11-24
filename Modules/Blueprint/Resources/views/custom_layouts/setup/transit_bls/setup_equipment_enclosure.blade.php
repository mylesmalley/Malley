


<div id="menu" class="card border-dark">
    <div class="card-header bg-dark text-white">
        Options
    </div>

        <div class="list-group">


            <span class="list-group-item list-group-item-action"
                  onclick="add_image('freedman_single_fixed_passenger')" >
                    Freedman Single Fixed (Passenger)
            </span>





        </div>

    </div>


<script>

    // 6123 	FTB-Z997-002 	1 	CHASSIS SELECTION - 148" HIGH ROOF
    @if( $c->contains('FTB-Z997-002') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/bls/patient-transfer-wall-reg-WB.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });
    @endif

    // 6123 	FTB-Z997-003	1 	CHASSIS SELECTION - 148" HIGH ROOF EXTENDED
    @if( $c->contains('FTB-Z997-003') )
    Konva.Image.fromURL(  `{{ mix('img/blueprint/bls/patient-transfer-wall-EXT.png') }}` , function (bg) {
        bg.setAttrs({
            x: 0,
            y: 0,
            zindex:0,
        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif






</script>