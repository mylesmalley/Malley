<div class="list-group">

    @if( ! $configuration->contains('FTB-Z999-001') )

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 5]) }}">

            <h4 class="text-primary">Chassis</h4>
            <p>Wheelbase, roof height, and style of vehicle.</p>
        </a>
        <div class="list-group-item list-group-item-secondary">
            As you configure this van, more forms will appear here.
        </div>

    @else
        <div class="list-group-item list-group-item-success">
            <h4 class="text-success">Van Configured!
                <img src="{{ mix('img/checkmark.png') }}"
                     class="float-end"
                     width="30"
                     height="30"
                     alt="">
            </h4>
        </div>
    @endif


        <!-- go no further if the chassis hasn't even been picked -->
        @if(  $configuration->contains('FTB-Z999-001') )



            {{-- ONE STRETCHER POSITION --}}
            @if(  $configuration->contains('FTB-Z993-004')  )
                {{-- Stretcher configuration wizard done?--}}
                @if( !$configuration->contains('FTB-Z999-002') )
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.wizard', [ $blueprint, 6]) }}">
                        <h4 class="text-primary">Stretcher Position</h4>
                        <p>Brand and model of stretcher mount.</p>
                    </a>
                @else
                    <div class="list-group-item list-group-item-success">
                        <h4 class="text-success">Stretcher Position Configured
                            <img src="{{ mix('img/checkmark.png') }}"
                                 class="float-end"
                                 width="30"
                                 height="30"
                                 alt="">
                        </h4>
                    </div>
                @endif
            @endif


            @if(  $configuration->contains('FTB-Z993-005') )
                {{-- Stretcher configuration wizard done?--}}
                @if( !$configuration->contains('FTB-Z999-002') )
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.wizard', [ $blueprint, 7]) }}">
                        <h4 class="text-primary">Two Stretcher Positions</h4>
                        <p>Brand and model of stretcher mounts for two-position configurations.</p>
                    </a>
                @else
                    <div class="list-group-item list-group-item-success">
                        <h4 class="text-success">Stretcher Position Configured
                            <img src="{{ mix('img/checkmark.png') }}"
                                 class="float-end"
                                 width="30"
                                 height="30"
                                 alt="">
                        </h4>
                    </div>
                @endif
            @endif


            {{--            FTB-Z993-001r1--}}
            {{--            LAYOUT - SIDE ENTRY LIFt--}}
            @if(  $configuration->contains('FTB-Z993-001') )
                <a class="list-group-item list-group-item-action"
                   href="{{ route('blueprint.wizard', [ $blueprint, 8]) }}">

                    <h4 class="text-primary">Side-Entry Wheelchair Lift</h4>
                    <p>Brand and model of wheelchair lift for side-entry applications.</p>
                </a>
            @endif


            {{-- REAR ENTRY LIFT --}}
            @if(  $configuration->contains('FTB-Z993-002') )
                <a class="list-group-item list-group-item-action"
                   href="{{ route('blueprint.wizard', [ $blueprint, 9]) }}">
                    <h4 class="text-primary">Rear-Entry Wheelchair Lift</h4>
                    <p>Brand and model of wheelchair lift for vehicles needing wheelchair access from the rear..</p>
                </a>
            @endif



{{--            LAYOUT - ONE STRETCHER POSITION ON DRIVER SIDE--}}
            @if(  $configuration->contains('FTB-Z993-006') )
                {{-- Stretcher configuration wizard done?--}}
                @if( !$configuration->contains('FTB-Z999-002') )
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.wizard', [ $blueprint, 12]) }}">
                        <h4 class="text-primary">Stretcher Mount (with wheelchair lift)</h4>
                        <p>Brand and model of stretcher mounts for configurations with a wheelchair lift.</p>
                    </a>
                @else
                    <div class="list-group-item list-group-item-success">
                        <h4 class="text-success">Stretcher Position Configured
                            <img src="{{ mix('img/checkmark.png') }}"
                                 class="float-end"
                                 width="30"
                                 height="30"
                                 alt="">
                        </h4>
                    </div>
                @endif
            @endif





                <a class="list-group-item list-group-item-action"
                   href="{{ route('blueprint.custom_layout', [ $blueprint, 'floor' ]) }}">

                    <h4 class="text-primary">Floor Layout</h4>
                    <p>Drag and drop the components you want added to this vehicle design.</p>
                </a>



        {{-- USAGE - PATIENT TRANSFER / BLS VEHICLE --}}
        @if( $configuration->contains('FTB-Z998-002'))
            <a class="list-group-item list-group-item-action"
               href="{{ route('blueprint.custom_layout', [ $blueprint, "equipment_enclosure" ]) }}">

                <h4 class="text-primary">Equipment Enclosure Layout</h4>
                <p>Drag and drop the components you want added to the rear-driver-side wall.</p>
            </a>
        @endif

    @endif



</div>