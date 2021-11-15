
@if ( $configuration->contains('FTM-K001-001')
    || $configuration->contains('FTM-K002-001')
    || $configuration->contains('FTM-K003-001')  )
    {{-- only show for SMART floors --}}
    @includeIf('blueprint::floor_layout.transit_mobility.smart_floor_menu')
    @includeIf('blueprint::floor_layout.transit_mobility.smart_floor_options')


@else
    {{-- only show for regular floors --}}
    @includeIf('blueprint::floor_layout.transit_mobility.standard_floor_menu')
    @includeIf('blueprint::floor_layout.transit_mobility.standard_floor_options')

@endif

<script>
    @if ( $configuration->contains('FTM-Z200-002') || $configuration->contains('FTM-Z200-003') )

    /*
        148 WHEELBASE VANS
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wb-interior.png') }}` , function (bg) {
        bg.setAttrs({
            x: 0,
            y: 0,
        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @if ( $configuration->contains('FTM-Z2003-001') )
    /*
        SIDE LIFT
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {
        bg.setAttrs({
            x: 350,
            y: 60,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif


    @if ( $configuration->contains('FTM-Z2003-002') )
    /*
        REAR LIFT
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {
        bg.setAttrs({
            x: 785,
            y: 110,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif


    @if ( $configuration->contains('FTM-E053-001') )
    /*
        REAR R A M P
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ramp.png') }}` , function (bg) {
        bg.setAttrs({
            x: 795,
            y: 115,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif
    @endif



    @if ( $configuration->contains('FTM-Z200-004') )
    /*
        148 EXTENDED WHEELBASE VANS
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wbext-interior.png') }}` , function (bg) {
        bg.setAttrs({
            x: 0,
            y: 0,
        });
        floorLayer.add(bg);
        floorLayer.draw();
    });

    @if ( $configuration->contains('FTM-Z2003-001') )
    /*
        SIDE LIFT
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {
        bg.setAttrs({
            x: 350,
            y: 60,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif

    @if ( $configuration->contains('FTM-Z2003-002') )
    /*
        REAR LIFT
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {
        bg.setAttrs({
            x: 915,
            y: 110,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif

    @if ( $configuration->contains('FTM-E053-001') )
    /*
        REAR R A M P
     */
    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ramp.png') }}` , function (bg) {
        bg.setAttrs({
            x: 926,
            y: 115,
            zIndex: 1000,
        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif
    @endif



    /*
Driver side running board
*/
    @if ( $configuration->contains('FTM-G001-001') )

    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ds-running-short.png') }}` , function (bg) {
        bg.setAttrs({
            x: 160,
            y: 331,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif

    /*
        PASSENGER SIDE RUNNING BOARDS
     */
    @if ( $configuration->contains('FTM-G003-001') )

    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ps-running-short.png') }}` , function (bg) {
        bg.setAttrs({
            x: 160,
            y: 30,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif

    @if ( $configuration->contains('FTM-G004-001') )

    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ps-running-long.png') }}` , function (bg) {
        bg.setAttrs({
            x: 160,
            y: 30,
            zIndex: 1000,

        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif

    @if ( $configuration->contains('FTM-G008-001') )

    Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/rpm-easy-step.png') }}` , function (bg) {
        bg.setAttrs({
            x: 350,
            y: 50,
            zIndex: 1000,
        });
        floorLayer.add(bg);
        floorLayer.draw();
    });
    @endif




</script>