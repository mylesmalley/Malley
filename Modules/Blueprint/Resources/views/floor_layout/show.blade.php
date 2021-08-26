@extends('blueprint::layouts.master')

@section('stylesheet')
    <style>
        #menu {
            display: none;
            position: absolute;
            z-index: 10000;
            /*width: 60px;*/
            background-color: white;
            box-shadow: 0 0 5px grey;
            border-radius: 3px;
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
                image: '',
                options: [
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_no_extension: {
                image: '',
                options: [
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_no_extension: {
                image: '',
                options: [
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_no_extension: {
                image: '',
                options: [
                    'FTM-P008-001', // passenger double fold
                ],
            },

            // 8" extension
            single_fixed_passenger_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001',  // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            // 12 in extension
            single_fixed_passenger_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P007-001', 	//FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P004-001', 	// FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            // 18" extension
            single_fixed_passenger_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            single_folding_passenger_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P007-001', //FREEDMAN SINGLE SEAT - PASSENGER SIDE - FOLD
                ],
            },
            double_fixed_passenger_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P004-001', // FREEDMAN DOUBLE SEAT - PASSENGER SIDE - FIX
                ],
            },
            double_folding_passenger_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P008-001', // passenger double fold
                ],
            },


            /*
            * DRIVER SIDE
            * */
            single_fixed_driver_no_extension: {
                image: '',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_no_extension: {
                image: '',
                options: [
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_no_extension: {
                image: '',
                options: [
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_no_extension: {
                image: '',
                options: [
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 8" extension
            single_fixed_driver_8in_extension: {
                image: '',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_8in_extension: {
                image: '',
                options: [
                    'FTM-P009-001', // seat belt extension
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 12 in extension
            single_fixed_driver_12in_extension: {
                image: '',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_12in_extension: {
                image: '',
                options: [
                    'FTM-P010-001', // seat belt extension
                    'FTM-P006-001', // driver double fold
                ],
            },


            // 18" extension
            single_fixed_driver_18in_extension: {
                image: '',
                options: [
                    'FTM-P001-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                    'FTM-P003-001', // FREEDMAN SINGLE SEAT - driver SIDE - FIX
                ],
            },
            single_folding_driver_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P005-001', 	//FREEDMAN SINGLE SEAT - driver SIDE - FOLD
                ],
            },
            double_fixed_driver_18in_extension: {
                image: '',
                options: [
                    'FTM-P011-001', // seat belt extension
                    'FTM-P002-001', // FREEDMAN DOUBLE SEAT - driver SIDE - FIX
                ],
            },
            double_folding_driver_18in_extension: {
                image: '',
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



         function drawFloor( url )
        {
            floorLayer.destroyChildren();
            Konva.Image.fromURL(  url , function (bg) {
                bg.setAttrs({
                    x: 0,
                    y: 0,
                });
                floorLayer.add(bg);
                floorLayer.draw();
            });

        }
            drawFloor( `{{ mix('img/blueprint/floors/transit130.png') }}`  );




        let tracked_x;
        let tracked_y;


        let currentShape;
        let menuNode = document.getElementById('menu');
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




        function add( list )
        {
            // alert( options[list] )
        //    alert(tracked_x + ' ' + tracked_y)

            var newShape = new Konva.Circle({
                x: tracked_x,
                y: tracked_y,
                radius: 10 + Math.random() * 30,
                fill: Konva.Util.getRandomColor(),
                shadowBlur: 10,
                draggable: true,
            });
            floorLayer.add(newShape);


            floorLayer.draw();
        }





        window.addEventListener('click', () => {
            // hide menu
            menuNode.style.display = 'none';
        });


        stage.on('contextmenu', function (e) {
            // prevent default behavior
            e.evt.preventDefault();
            tracked_x = stage.getPointerPosition().x;
            tracked_y = stage.getPointerPosition().y;
            console.log(tracked_x + ' ' + tracked_y)
            // if (e.target === stage) {
            //     // if we are on empty place of the stage we will do nothing
            //     return;
            // }
      //      currentShape = e.target;
            // show menu
            menuNode.style.display = 'initial';
            var containerRect = stage.container().getBoundingClientRect();
            menuNode.style.top =
                containerRect.top + stage.getPointerPosition().y + 4 + 'px';
            menuNode.style.left =
                containerRect.left + stage.getPointerPosition().x + 4 + 'px';
        });


    </script>

    @endpush