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


        function add_image( list, stored_x = null, stored_y = null )
        {
            Konva.Image.fromURL( options[list].image, function (image )  {

                seatLayer.add(image);

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
                        x: tracked_x,
                        y: tracked_y,
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
                        console.log( image.getAttr('options') );

                        console.log( stage.toJSON() );

                        image.destroy();
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

            //        seatLayer.draw();
                });



                seatLayer.draw();

            });

        }






        const width = 1100;
        const height = 450;
        const GRID_SIZE = 10;


        let preset = {"attrs":{"width":1100,"height":450},"className":"Stage","children":[{"attrs":{},"className":"Layer","children":[{"attrs":{"source":"/img/blueprint/floors/transit130.png?id=27587723ec9081533846"},"className":"Image"}]},{"attrs":{},"className":"Layer","children":[{"attrs":{"x":449.5,"y":125.85000610351562,"options":["FTM-P001-001"],"grouping":"single_fixed_driver_no_extension","source":"/img/blueprint/seats/single-driver.png?id=5b55c8aa20305dedb6a7","draggable":true},"className":"Image"},{"attrs":{"x":588.5,"y":223.85000610351562,"options":["FTM-P011-001","FTM-P003-001"],"grouping":"single_fixed_passenger_18in_extension","source":"/img/blueprint/seats/single-passenger.png?id=02dde1faa6744ac88303","draggable":true},"className":"Image"},{"attrs":{"x":270,"y":120,"options":["FTM-P006-001"],"grouping":"double_folding_driver_no_extension","source":"/img/blueprint/seats/double-driver.png?id=cc04a677e568c6845c70","draggable":true},"className":"Image"}]}]};



        let stage;

        if ( preset )
        {
            stage = Konva.Node.create(preset, 'konvaStage');

            stage.find('Image').forEach( function( el ){

                if( el.getAttr( 'grouping' ) )
                {
                    add_image( el.getAttr( 'grouping'), el.x(), el.y() );
                }

            });
        }
        else
        {
            stage = new Konva.Stage({
                container: 'konvaStage',
                width: width,
                height: height,
            });
        }


        let floorLayer = new Konva.Layer();
        stage.add(floorLayer);


        let seatLayer = new Konva.Layer();
        stage.add(seatLayer);


        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/transit130.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
            });
            bg.setAttr('source', `{{ mix('img/blueprint/floors/transit130.png') }}`);
            floorLayer.add(bg);
            floorLayer.draw();
        });


        let tracked_x;
        let tracked_y;

        let menuNode = document.getElementById('menu');
        let objectMenu = document.getElementById('object_menu');


        let clientx;
        let clienty;

        window.addEventListener('mousemove', function(e){
            clientx = e.pageX;
            clienty = e.pageY;

        });



        window.addEventListener('click', () => {
            // hide menu
            menuNode.style.display = 'none';
            objectMenu.style.display = 'none';
        });



        stage.on('contextmenu', function (e) {
            // prevent default behavior
            e.evt.preventDefault();

            tracked_x = stage.getPointerPosition().x;
            tracked_y = stage.getPointerPosition().y;

            menuNode.style.display = 'initial';
            let containerRect = stage.container().getBoundingClientRect();
            menuNode.style.top =
                containerRect.top + stage.getPointerPosition().y + 4 + 'px';
            menuNode.style.left =
                containerRect.left + stage.getPointerPosition().x + 4 + 'px';
        });






    </script>

    @endpush