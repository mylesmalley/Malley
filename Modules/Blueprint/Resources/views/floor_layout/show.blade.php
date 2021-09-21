@extends('blueprint::layouts.master')

@section('stylesheet')
    <style>
        #menu {
            display: none;
            position: absolute;
            z-index: 10000;
            box-shadow: 0 0 5px grey;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Floor Layout</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>





    <div class="row">
        <div class="col-9">
            <div id="konvaStage"></div>
        </div>
        <div class="col-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Instructions
                </div>
                <div class="card-body">
                    <p>Right click anywhere on the floor diagram to open up a box with options. Click on a button next to any option to add it to the layout.</p>
                    <p>Drag any item you have added to the floor layout around to wherever you'd like it positioned.</p>
                    <p>Double-click on any item on the floor layout to delete it.</p>
                    <p>Any changes you make are saved automatically. You can leave this form and come back later.</p>
                    <p>Click "Confirm Seat Layout" when you are done.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            @livewire("blueprint::floor-layout-progress", [$blueprint] )

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

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
    @includeIf('blueprint::floor_layout.shared.floor_layout_management_script')

    <script>
        @if ( $configuration->contains('FTM-Z200-001') )
            /*
                    1 3 0  WHEELBASE VANS
             */
            Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/ftm-130wb-interior.png') }}` , function (bg) {
                bg.setAttrs({
                    x: 0,
                    y: 0, //FTM-Z200-001
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
                        x: 710,
                        y: 110,
                    });
                    floorLayer.add(bg);
                    floorLayer.draw();
                });
            @endif

        @endif












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

    @endpush