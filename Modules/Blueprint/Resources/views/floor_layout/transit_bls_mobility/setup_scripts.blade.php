
<script>
    // 6122 	FTB-Z997-001 	1 	CHASSIS SELECTION - 148" MID ROOF
    @if( $c->contains('FTB-Z997-001') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wb-interior.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });


    // 6136 	FTB-Z993-001 	1 	LAYOUT - SIDE ENTRY LIFT
    // 6137 	FTB-Z993-002 	1 	LAYOUT - REAR ENTRY LIFT
    // 6138 	FTB-Z993-003 	1 	LAYOUT - REAR ENTRY RAMP
    // 6139 	FTB-Z993-004 	1 	LAYOUT - ONE STRETCHER POSITION
    // 6140 	FTB-Z993-005 	1 	LAYOUT - TWO STRETCHER POSITIONS
    //

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

    // 6123 	FTB-Z997-002 	1 	CHASSIS SELECTION - 148" HIGH ROOF
    @if( $c->contains('FTB-Z997-002') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wb-interior.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });
    @endif


    // 6124 	FTB-Z997-003 	1 	CHASSIS SELECTION - 148" HIGH ROOF EXTENDED
    @if( $c->contains('FTB-Z997-003') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wbext-interior.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });
    @endif


{{--    @if ( $configuration->contains('FTM-Z200-002') || $configuration->contains('FTM-Z200-003') )--}}
{{--    --}}
{{--        /*--}}
{{--            148 WHEELBASE VANS--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wb-interior.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 0,--}}
{{--                y: 0,--}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        --}}
{{--        --}}
{{--        @if ( $configuration->contains('FTM-Z2003-001') )--}}
{{--        /*--}}
{{--            SIDE LIFT--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 350,--}}
{{--                y: 60,--}}
{{--                zIndex: 1000,--}}
{{--    --}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--    --}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-Z2003-002') )--}}
{{--        /*--}}
{{--            REAR LIFT--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 785,--}}
{{--                y: 110,--}}
{{--                zIndex: 1000,--}}
{{--    --}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--    --}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-E053-001') )--}}
{{--        /*--}}
{{--            REAR R A M P--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ramp.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 795,--}}
{{--                y: 115,--}}
{{--                zIndex: 1000,--}}
{{--    --}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--        @endif--}}
{{--    --}}
{{--    --}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-Z200-004') )--}}
{{--        /*--}}
{{--            148 EXTENDED WHEELBASE VANS--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wbext-interior.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 0,--}}
{{--                y: 0,--}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-Z2003-001') )--}}
{{--        /*--}}
{{--            SIDE LIFT--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 350,--}}
{{--                y: 60,--}}
{{--                zIndex: 1000,--}}
{{--    --}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-Z2003-002') )--}}
{{--        /*--}}
{{--            REAR LIFT--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 915,--}}
{{--                y: 110,--}}
{{--                zIndex: 1000,--}}
{{--    --}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--    --}}
{{--        @if ( $configuration->contains('FTM-E053-001') )--}}
{{--        /*--}}
{{--            REAR R A M P--}}
{{--         */--}}
{{--        Konva.Image.fromURL(  `{{ mix('img/blueprint/other/ramp.png') }}` , function (bg) {--}}
{{--            bg.setAttrs({--}}
{{--                x: 926,--}}
{{--                y: 115,--}}
{{--                zIndex: 1000,--}}
{{--            });--}}
{{--            floorLayer.add(bg);--}}
{{--            floorLayer.draw();--}}
{{--        });--}}
{{--        @endif--}}
{{--    @endif--}}






</script>