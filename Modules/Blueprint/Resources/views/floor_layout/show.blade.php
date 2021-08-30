@extends('blueprint::layouts.master')

@section('stylesheet')
    <style>
        #menu {
            display: none;
            position: absolute;
            z-index: 10000;
            /*width: 60px;*/
            /*background-color: white;*/
            box-shadow: 0 0 5px grey;
            /*border-radius: 3px;*/
        }

        #object_menu {
            display: none;
            position: absolute;
            z-index: 10000;
            /*width: 60px;*/
            /*background-color: white;*/
            box-shadow: 0 0 5px grey;
            /*border-radius: 3px;*/
        }

        /*#menu button {*/
        /*    width: 100%;*/
        /*    background-color: white;*/
        /*    border: none;*/
        /*    margin: 0;*/
        /*    padding: 10px;*/
        /*}*/

        /*#menu button:hover {*/
        /*    background-color: lightgray;*/
        /*}*/
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




    <div id="object_menu" class="card border-success">
        <div class="card-header">
            Delete This Item?
        </div>
        <div class="card-body">
            asdfdsaf
        </div>
    </div>


        <div id="menu" class="card border-danger">
        <div class="card-header">
            Add a new Item
        </div>
        <div class="card-body">

        <table>
            <thead>

                <tr>
                    <th>Seat</th>
                    <th colspan="4">Belt extension</th>
                </tr>
            </thead>

            <tbody>


                <tr>
                    <td>Single Fixed, Passenger</td>
                    <td> <button onclick="add_image('single_fixed_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('single_fixed_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('single_fixed_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('single_fixed_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Single Folding, Passenger</td>
                    <td> <button onclick="add_image('single_folding_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('single_folding_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('single_folding_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('single_folding_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Fixed, Passenger</td>
                    <td> <button onclick="add_image('double_fixed_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('double_fixed_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('double_fixed_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('double_fixed_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Folding, Passenger</td>
                    <td> <button onclick="add_image('double_folding_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('double_folding_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('double_folding_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('double_folding_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>

                <tr>
                    <td>Single Fixed, Driver</td>
                    <td> <button onclick="add_image('single_fixed_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('single_fixed_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('single_fixed_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('single_fixed_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Single Folding, Driver</td>
                    <td> <button onclick="add_image('single_folding_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('single_folding_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('single_folding_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('single_folding_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Fixed, Driver</td>
                    <td> <button onclick="add_image('double_fixed_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('double_fixed_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('double_fixed_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('double_fixed_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Folding, Driver</td>
                    <td> <button onclick="add_image('double_folding_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add_image('double_folding_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add_image('double_folding_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add_image('double_folding_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
            
            </tbody>
        </table>
        </div>

    </div>

    <div id="konvaStage"></div>



@endsection

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

    <script>


        let options = {
            // no extension
            single_fixed_passenger_no_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_no_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_no_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_no_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P008-001', // passenger double fold
                ],
            },

            // 8" extension
            single_fixed_passenger_8in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P009-001',  // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_8in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_8in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_8in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            // 12 in extension
            single_fixed_passenger_12in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_12in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_12in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_12in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            // 18" extension
            single_fixed_passenger_18in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_18in_extension: {
                image: '{{ mix('img/blueprint/seats/single-passenger.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P007-001', //FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_18in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P004-001', // FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_18in_extension: {
                image: '{{ mix('img/blueprint/seats/double-passenger.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            /*
            * DRIVER SIDE
            * */
            single_fixed_driver_no_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_no_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_no_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_no_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 8" extension
            single_fixed_driver_8in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_8in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_8in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_8in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 12 in extension
            single_fixed_driver_12in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_12in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_12in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_12in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 18" extension
            single_fixed_driver_18in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_18in_extension: {
                image: '{{ mix('img/blueprint/seats/single-driver.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_18in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_18in_extension: {
                image: '{{ mix('img/blueprint/seats/double-driver.png') }}',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P006-001', // driver double fold
                ],
            },
        };



        const width = 1100;
        const height = 450;
        const GRID_SIZE = 10;



@if( $blueprint->custom_layout )
      //  let preset = {"attrs":{"width":1100,"height":450},"className":"Stage","children":[{"attrs":{},"className":"Layer","children":[{"attrs":{"source":"/img/blueprint/floors/transit130.png?id=27587723ec9081533846"},"className":"Image"}]},{"attrs":{},"className":"Layer","children":[{"attrs":{"x":449.5,"y":125.85000610351562,"options":["FTM-P001-001"],"grouping":"single_fixed_driver_no_extension","source":"/img/blueprint/seats/single-driver.png?id=5b55c8aa20305dedb6a7","draggable":true},"className":"Image"},{"attrs":{"x":588.5,"y":223.85000610351562,"options":["FTM-P011-001","FTM-P003-001"],"grouping":"single_fixed_passenger_18in_extension","source":"/img/blueprint/seats/single-passenger.png?id=02dde1faa6744ac88303","draggable":true},"className":"Image"},{"attrs":{"x":270,"y":120,"options":["FTM-P006-001"],"grouping":"double_folding_driver_no_extension","source":"/img/blueprint/seats/double-driver.png?id=cc04a677e568c6845c70","draggable":true},"className":"Image"}]}]};
    let preset = {!!  $blueprint->custom_layout  !!};
@else
    let preset;
@endif


        let stage = new Konva.Stage({
            container: 'konvaStage',
            width: width,
            height: height,
        });




        let floorLayer = new Konva.Layer();
        stage.add(floorLayer);

        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/transit130.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });



        let seatLayer = new Konva.Layer();

        let rect = Konva.Rect
        stage.add(seatLayer);

        if ( preset )
        {
            //console.log( preset.children );
            for (let i = 0; i < preset.children.length; i++ )
            {
                // console.log( preset.children[i].attrs.x);

                add_image(  preset.children[i].attrs.grouping, preset.children[i].attrs.x, preset.children[i].attrs.y )
            }

          //  store_layout();
        }





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


            fetch('{{ route('blueprint.floor_layout.store', [$blueprint]) }}', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    layout: seatLayer.toJSON(),
                    '_token': document.head.querySelector('meta[name="csrf-token"]').content
                }),
            });

        }


        function add_image( list, stored_x = null, stored_y = null )
        {

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







    </script>

    @endpush