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
            <h3 class="text-secondary">{{ $layout->name ?? "NA" }} Layout</h3>
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
        <div class="col-12">
            <div id="konvaStage"></div>
        </div>

    </div>

    <div class="row">

        <div class="col-6">
            @livewire("blueprint::custom-layout-progress", [$blueprint, $layout] )
        </div>


        <div class="col-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Instructions
                </div>
                <div class="card-body">
                    <p>Right click anywhere on the floor diagram to open up a box with options. Click on a button next to any option to add it to the layout.</p>
                    <p>Drag any item you have added to the floor layout around to wherever you'd like it positioned.</p>
                    <p>Double-click on any item on the floor layout to delete it.</p>
                    <p>Any changes you make are saved automatically. You can leave this form and come back later.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>

@endsection


@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

{{--     REgular transit mobility - legacy stuff--}}
{{--    @if( (int)$blueprint->base_van_id === 11)--}}
{{--        @include('blueprint::floor_layout.transit_mobility.setup_scripts')--}}
{{--    @endif--}}

{{--     BLS--}}
    @if( (int)$blueprint->base_van_id === 31)
        @includeIf('blueprint::custom_layouts.setup.transit_bls.components')

        @if ($layout->name === 'floor')
            @include('blueprint::custom_layouts.setup.transit_bls.setup_floor', [ 'c' => $configuration ])
        @endif
        @if ($layout->name === 'equipment_enclosure')
            @include('blueprint::custom_layouts.setup.transit_bls.setup_equipment_enclosure', [ 'c' => $configuration ])
        @endif
    @endif









    <script>
        const width = 1100;
        const height = 650;
        const GRID_SIZE = 10;

        let stage = new Konva.Stage({
            container: 'konvaStage',
            width: width,
            height: height,
        });

        let floorLayer = new Konva.Layer();
        stage.add(floorLayer);

        let fixedComponentLayer = new Konva.Layer();
        stage.add(fixedComponentLayer);

        let seatLayer = new Konva.Layer();
        stage.add(seatLayer);

        let menuNode = document.getElementById('menu');


        let page_x;
        let page_y;
        let canvas_x;
        let canvas_y;

        window.addEventListener('mousemove', function(e){
            page_x = e.pageX;
            page_y = e.pageY;
        });

        window.addEventListener('click', () => {
            // hide menu
            menuNode.style.display = 'none';
        });


        stage.on('contextmenu', function (e) {
            // prevent default behavior
            e.evt.preventDefault();

            canvas_x = stage.getPointerPosition().x;
            canvas_y = stage.getPointerPosition().y;
            menuNode.style.display = 'initial';
            menuNode.style.top = page_y  + 'px';
            menuNode.style.left = page_x  + 'px';
        });


        function store_layout()
        {
            console.log( seatLayer.toJSON() )

            fetch('{{ route('blueprint.custom_layout.change', [$blueprint, $layout->name ]) }}', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    layout: seatLayer.toJSON(),
                    '_token': document.head.querySelector('meta[name="csrf-token"]').content
                }),
            });


            // fire off livewire event to update progress box
            Livewire.emit('update_floor_layout_progress');
        }

        function add_image( list, stored_x = null, stored_y = null )
        {

            if ( !options[list] )
            {
                console.error('could not find ' + list );
                return false;
            }
            else
            {
                console.log( 'found '+list+' and placed at '+stored_x + " " + stored_y);
            }

            Konva.Image.fromURL( options[list].image, function (image )  {

                if( stored_x !== null && stored_y !== null)
                {
                    image.position({
                        x: stored_x,
                        y: stored_y,
                    });
                }
                else
                {
                    image.position({
                        x: canvas_x,
                        y: canvas_y,
                    });
                }


                // assign the new object an id
                image.setAttr('options', options[list].options );
                image.setAttr('grouping', list );
                image.setAttr('source', options[list].image);


                image.draggable(true);


                image.on('dblclick', function (event) {

                    // stops the contextmnu event from propagating up to the canvas event
                    event.cancelBubble = true;

                    if( window.confirm("Delete this object?") )
                    {

                        image.destroy();
                        store_layout();
                    }

                });


                // round the object's position to snap to grid
                image.addEventListener('dragend', function( ){

                    // snap the location to the bounding box of the stage to make sure nothing gets hidden
                    if ( image.x() < 0 ) image.x(0);
                    if ( image.y() < 0 ) image.y(0);
                    if ( ( image.x() + image.width()) > width ) image.x(width  - image.width());
                    if ( ( image.y() + image.height()) > height ) image.y(width  - image.height());

                    image.position({
                        x: Math.round( image.x() / GRID_SIZE) * GRID_SIZE,
                        y: Math.round( image.y() / GRID_SIZE) * GRID_SIZE,
                    });

                    seatLayer.draw();

                    store_layout();
                });


                seatLayer.add(image);
                store_layout();


            });


        }


        let preset;

        @if( $layout->layout )
{{--        {{ dd( $layout->layout ) }}--}}
            preset = {!!  $layout->layout  !!};
        @endif

        if ( preset )
        {
            for (let i = 0; i < preset.children.length; i++ )
            {
                console.log(preset.children[i].attrs.grouping, preset.children[i].attrs.x, preset.children[i].attrs.y );
                add_image(  preset.children[i].attrs.grouping, preset.children[i].attrs.x, preset.children[i].attrs.y )
            }
        }
    </script>



@endpush