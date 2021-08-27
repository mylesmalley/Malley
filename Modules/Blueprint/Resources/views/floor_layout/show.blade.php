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
                    <td> <button onclick="add('single_fixed_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('single_fixed_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('single_fixed_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('single_fixed_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Single Folding, Passenger</td>
                    <td> <button onclick="add('single_folding_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('single_folding_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('single_folding_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('single_folding_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Fixed, Passenger</td>
                    <td> <button onclick="add('double_fixed_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('double_fixed_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('double_fixed_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('double_fixed_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Folding, Passenger</td>
                    <td> <button onclick="add('double_folding_passenger_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('double_folding_passenger_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('double_folding_passenger_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('double_folding_passenger_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>

                <tr>
                    <td>Single Fixed, Driver</td>
                    <td> <button onclick="add('single_fixed_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('single_fixed_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('single_fixed_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('single_fixed_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Single Folding, Driver</td>
                    <td> <button onclick="add('single_folding_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('single_folding_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('single_folding_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('single_folding_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Fixed, Driver</td>
                    <td> <button onclick="add('double_fixed_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('double_fixed_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('double_fixed_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('double_fixed_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
                </tr>
                <tr>
                    <td>Double Folding, Driver</td>
                    <td> <button onclick="add('double_folding_driver_no_extension')" class="btn btn-sm action-button  btn-dark">None</button>  </td>
                    <td> <button onclick="add('double_folding_driver_8in_extension')"   class="btn btn-sm action-button   btn-success">12"</button>  </td>
                    <td> <button onclick="add('double_folding_driver_12in_extension')"  class="btn  btn-sm action-button  btn-warning">18"</button>  </td>
                    <td> <button onclick="add('double_folding_driver_18in_extension')"   class="btn btn-sm action-button   btn-danger">24"</button>  </td>
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

        // const deleteBoxX = 0;
        // const deleteBoxY = height -150;
        // const deleteBoxWidth = width;
        // const deleteBoxHeight = 150;

        let stage = new Konva.Stage({
            container: 'konvaStage',
            width: width,
            height: height,
        });


        let floorLayer = new Konva.Layer();
        stage.add(floorLayer);


        let seatLayer = new Konva.Layer();
        stage.add(seatLayer);



        //  function drawFloor( url )
        // {
        //     floorLayer.destroyChildren();
            Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/transit130.png') }}` , function (bg) {
                bg.setAttrs({
                    x: 0,
                    y: 0,
                });
                bg.setAttr('source', `{{ mix('img/blueprint/floors/transit130.png') }}`);
                floorLayer.add(bg);
                floorLayer.draw();
            });

        // }
        //    drawFloor( `{{ mix('img/blueprint/floors/transit130.png') }}`  );




        let tracked_x;
        let tracked_y;


      //  let currentShape;
        let menuNode = document.getElementById('menu');
        let objectMenu = document.getElementById('object_menu');
       // let action_buttons = document.getElementsByClassName('action-button')
       //
       //  for(let i = 0; i < action_buttons.length; i++ )
       //  {
       //      action_buttons[i].addEventListener('click', () => {
       //
       //
       //
       //         // alert('clicked')
       //          // currentShape.to({
       //          //     scaleX: 2,
       //          //     scaleY: 2,
       //          //     onFinish: () => {
       //          //         currentShape.to({ scaleX: 1, scaleY: 1 });
       //          //     },
       //          // });
       //      });
       //  }


        let clientx;
        let clienty;
        window.addEventListener('mousemove', function(e){
            clientx = e.pageX;
            clienty = e.pageY;

         // console.error( e.pageX, e.pageY );
        });




        function add( list )
        {
            // alert( options[list] )
        //    alert(tracked_x + ' ' + tracked_y)

            // var newShape = new Konva.Circle({
            //     x: tracked_x,
            //     y: tracked_y,
            //     radius: 10 + Math.random() * 30,
            //     fill: Konva.Util.getRandomColor(),
            //     shadowBlur: 10,
            //     draggable: true,
            // });
            // floorLayer.add(newShape);
            //
            //
            // floorLayer.draw();



            Konva.Image.fromURL( options[list].image, function (image )  {
                seatLayer.add(image);

                // image.x = tracked_x;
                // image.y = tracked_y;
                    image.position({
                        x: tracked_x,
                        y: tracked_y,
                    });
                // associate to the seat or wheelchair the name from the toybox object for info retrieval
             //   image.setAttr('toyName', selectedToy);


                // assign the new object an id
                image.setAttr('options', options[list].options );
                image.setAttr('grouping', list );
                image.setAttr('source', options[list].image);

                // // if the node id already exists, draw from storage. otherwise create a new one.
                // if (locations.parts.hasOwnProperty( nodeId ))
                // {
                //     // set the position from storage
                //     image.position({
                //         x: locations.parts[nodeId].x,
                //         y: locations.parts[nodeId].y,
                //     });
                //
                //     // rotate a loaded node if required
                //     if( locations.parts[nodeId].hasOwnProperty('rotate' ) )
                //     {
                //         image.rotate( locations.parts[nodeId].rotate );
                //     }
                // }
                // // the node doesn't exist so create a new one.
                // else
                // {
                //     // snap to grid on initial drop
                //     image.position(stage.getPointerPosition())
                //     image.position({
                //         x: Math.round( image.x() / GRID_SIZE) * GRID_SIZE,
                //         y: Math.round( image.y() / GRID_SIZE) * GRID_SIZE,
                //     });
                // }

                image.draggable(true);


                // create a new node in the locations object for use in rebuilding
                // will overwrite if it already exists but doesn't matter since it's being re-drawn
                // locations.parts[nodeId] = {
                //     x: image.x(),
                //     y: image.y(),
                //     toyName: image.getAttr('toyName'),
                //     rotate: image.getRotation()
                // }



                // // should the object be rotate-able?
                // if ( toys[ image.getAttr('toyName') ].hasOwnProperty('rotate')
                //     && toys[ image.getAttr('toyName')].rotate)
                // {
                //     image.addEventListener('click', function(){
                //         locations.parts[nodeId].rotate += 45;
                //         image.rotate(45);
                //         layer.draw();
                //     });
                // }


                image.on('dblclick', function (event) {

                    // stops the contextmnu event from propagating up to the canvas event
                    event.cancelBubble = true;

                    if( window.confirm("Delete this object?") )
                    {
                        console.log( image.getAttr('options') );

                        console.log( stage.toJSON() );

                        image.destroy();
                    }

                    //console.log( 'show it!' );

                //     objectMenu.style.display = 'initial';
                // //    let containerRect = stage.container().getBoundingClientRect();
                //     objectMenu.style.top = clienty + "px";
                //     // objectMenu.style.top = parseInt(imgpos.y + imgsize.height + 4) + "px";
                //     //    containerRect.top + tracked_y + 4 + 'px';
                //     // objectMenu.style.left = parseInt(imgpos.x + imgsize.width + 4) + "px";
                //     objectMenu.style.left = clientx + "px";
                    //    containerRect.left + tracked_x + 4 + 'px';
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


                    // // update node location in locations object
                    // locations.parts[nodeId].x = image.x();
                    // locations.parts[nodeId].y = image.y();



                    // // determine if it lands in the delete box bounds
                    // if (
                    //     (image.x() >= deleteBoxX +10) &&
                    //     (image.x() <= deleteBoxX + deleteBoxWidth- 10) &&
                    //     (image.y() >=  deleteBoxY + 10) &&
                    //     (image.y() <= deleteBoxY + deleteBoxHeight - 10 )
                    // )
                    // {
                    //
                    //     // delete the object if true
                    //     // decrease quantity in manifest
                    //     //     locations.quantities[ toys[ selectedToy ].code ] --;
                    //
                    //     image.destroy();
                    //
                    //     // unset the location
                    //     delete locations.parts[nodeId];
                    // }

                    seatLayer.draw();
                });



                seatLayer.draw();
            });



        }





        window.addEventListener('click', () => {
            // hide menu
            menuNode.style.display = 'none';
            objectMenu.style.display = 'none';
        });




            stage.on('contextmenu', function (e) {
                // prevent default behavior
                e.evt.preventDefault();

                // console.log('context menu')

                tracked_x = stage.getPointerPosition().x;
                tracked_y = stage.getPointerPosition().y;
             //   console.log(tracked_x + ' ' + tracked_y)
                // if (e.target === stage) {
                //     // if we are on empty place of the stage we will do nothing
                //     return;
                // }
                //      currentShape = e.target;
                // show menu
                menuNode.style.display = 'initial';
                let containerRect = stage.container().getBoundingClientRect();
                menuNode.style.top =
                    containerRect.top + stage.getPointerPosition().y + 4 + 'px';
                menuNode.style.left =
                    containerRect.left + stage.getPointerPosition().x + 4 + 'px';
            });






    </script>

    @endpush