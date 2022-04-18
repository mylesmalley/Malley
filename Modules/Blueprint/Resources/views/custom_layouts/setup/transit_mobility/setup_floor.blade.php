


<div id="menu" class="card border-dark">
    <div class="card-header bg-dark text-white">
        Options
    </div>

        <div class="list-group">

            <!-- WHEELCHAIR LIFT OR RAMP  -->
{{--            @if( $c->contains('FTM-Z993-001') || $c->contains('FTM-Z993-002') || $c->contains('FTM-Z993-003') )--}}

                <!-- L TRACK FLOORING  -->
                @if( $c->contains('FTM-M001-001') ||  $c->contains('FTM-M002-001') ||  $c->contains('FTM-M003-001') )
                    <span class="list-group-item list-group-item-action"
                        onclick="add_image('wheelchair_ltrack')" >
                        Wheelchair Position
                    </span>
                        <span class="list-group-item list-group-item-action"
                              onclick="add_image('shoulder_harness_label')" >
                        Shoulder Harness
                    </span>


                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_fixed_passenger')" >
                        Freedman Single Fixed (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_fixed_driver')" >
                        Freedman Single Fixed (Drover)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_folding_passenger')" >
                        Freedman Single Folding (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_folding_driver')" >
                        Freedman Single Folding (Drover)
                </span>

                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_fixed_passenger')" >
                        Freedman Double Fixed (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_fixed_driver')" >
                        Freedman Double Fixed (Drover)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_folding_passenger')" >
                        Freedman Double Folding (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_folding_driver')" >
                        Freedman Double Folding (Drover)
                </span>

                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_8')" >
                        8" Belt Extension
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_12')" >
                        12" Belt Extension
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_18')" >
                        18" Belt Extension
                </span>
                @endif

                <!-- SMARTFLOOR -->
                @if( $c->contains('FTM-K001-001') ||  $c->contains('FTM-K002-001') ||  $c->contains('FTM-K003-001') )
                    <span class="list-group-item list-group-item-action"
                          onclick="add_image('wheelchair_smartfloor')" >
                        Wheelchair Position
                    </span>
                        <span class="list-group-item list-group-item-action"
                              onclick="add_image('smartseat')" >
                        SmartSeat
                    </span>
                        <span class="list-group-item list-group-item-action"
                              onclick="add_image('smartseat_ez_passenger_side')" >
                        SMARTSEAT - EZ M1 TIP AND FOLD TURNY - PASSENGER SIDE
                    </span>

                        <span class="list-group-item list-group-item-action"
                              onclick="add_image('shoulder_harness_label')" >
                        Shoulder Harness
                    </span>


                @endif

                <!-- SNC FOR LONSEAL   -->
                @if( $c->contains('FTM-Z996-001') )
                    <span class="list-group-item list-group-item-action"
                          onclick="add_image('wheelchair_slide_and_click')" >
                        Wheelchair Position
                    </span>
                @endif

{{--            @endif--}}


            <!-- SEATING FOR LONSEAL flooring   -->
            @if( $c->contains('FTM-Z996-001') || $c->contains('FTM-Z996-003'))
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_fixed_passenger')" >
                        Freedman Single Fixed (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_fixed_driver')" >
                        Freedman Single Fixed (Drover)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_folding_passenger')" >
                        Freedman Single Folding (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_single_folding_driver')" >
                        Freedman Single Folding (Drover)
                </span>

                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_fixed_passenger')" >
                        Freedman Double Fixed (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_fixed_driver')" >
                        Freedman Double Fixed (Drover)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_folding_passenger')" >
                        Freedman Double Folding (Passenger)
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('freedman_double_folding_driver')" >
                        Freedman Double Folding (Drover)
                </span>

                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_8')" >
                        8" Belt Extension
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_12')" >
                        12" Belt Extension
                </span>
                <span class="list-group-item list-group-item-action"
                      onclick="add_image('belt_extension_18')" >
                        18" Belt Extension
                </span>

            @endif




        </div>

    </div>


<script>

    /*
        REGULAR WHEELBASE
     */
    // 6122 	FTM-Z997-001 	1 	CHASSIS SELECTION - 148" MID ROOF
    // 6123 	FTM-Z997-002 	1 	CHASSIS SELECTION - 148" HIGH ROOF
    @if( $c->contains('FTM-Z101-001') || $c->contains('FTM-Z200-002') || $c->contains('FTM-Z200-003') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wb-interior.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });


        // 6136 	FTM-Z993-001 	1 	LAYOUT - SIDE ENTRY LIFT
        @if( $c->contains('FTM-Z2003-001') )
            Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {
                bg.setAttrs({
                    x: 350,
                    y: 60,
                    zIndex: 100,
                });
            fixedComponentLayer.add(bg);
            fixedComponentLayer.draw();
            });
        @endif


        // 6137 	FTM-Z993-002 	1 	LAYOUT - REAR ENTRY LIFT
        @if( $c->contains('FTM-Z2003-002') )
            Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {
                bg.setAttrs({
                    x: 785,
                    y: 110,
                    zIndex: 100,
                });
            fixedComponentLayer.add(bg);
            fixedComponentLayer.draw();
            });
        @endif



        {{--// 6139 	FTM-Z993-004 	1 	LAYOUT - ONE STRETCHER POSITION--}}
        {{--@if( $c->contains('FTM-Z993-004') )--}}
        {{--    Konva.Image.fromURL(  `{{ mix('img/blueprint/other/stretcher.png') }}` , function (bg) {--}}
        {{--        bg.setAttrs({--}}
        {{--            x: 500,--}}
        {{--            y: 180,--}}
        {{--            zIndex: 100,--}}
        {{--        });--}}
        {{--    fixedComponentLayer.add(bg);--}}
        {{--    fixedComponentLayer.draw();--}}
        {{--    });--}}
        {{--@endif--}}


    @endif




    // 6138 	FTM-Z993-003 	1 	LAYOUT - REAR ENTRY RAMP







    /*
        EXTENDED WHEELBASE
     */



    // 6124 	FTM-Z997-003 	1 	CHASSIS SELECTION - 148" HIGH ROOF EXTENDED
    @if( $c->contains('FTM-Z997-003') )
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-148wbext-interior.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
                zindex:0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });


        // 6136 	FTM-Z993-001 	1 	LAYOUT - SIDE ENTRY LIFT
    @if( $c->contains('FTM-Z2003-001') )
            Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-side.png') }}` , function (bg) {
                bg.setAttrs({
                    x: 350,
                    y: 60,
                    zIndex: 100,
                });
            fixedComponentLayer.add(bg);
            fixedComponentLayer.draw();
            });
        @endif

        // 6137 	FTM-Z993-002 	1 	LAYOUT - REAR ENTRY LIFT
    @if( $c->contains('FTM-Z2003-002') )
            Konva.Image.fromURL(  `{{ mix('img/blueprint/other/wheelchair-lift-rear.png') }}` , function (bg) {
            bg.setAttrs({
                x: 915,
                y: 110,
                zIndex: 100,
            });
            fixedComponentLayer.add(bg);
            fixedComponentLayer.draw();
        });
        @endif





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