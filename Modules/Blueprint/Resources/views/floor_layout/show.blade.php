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
        asdfsd

    </div>

    <div id="konvaStage"></div>



@endsection

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

    <script>

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






        let currentShape;
        let menuNode = document.getElementById('menu');
        // document.getElementById('pulse-button').addEventListener('click', () => {
        //     alert('clicked')
        //     // currentShape.to({
        //     //     scaleX: 2,
        //     //     scaleY: 2,
        //     //     onFinish: () => {
        //     //         currentShape.to({ scaleX: 1, scaleY: 1 });
        //     //     },
        //     // });
        // });

        window.addEventListener('click', () => {
            // hide menu
            menuNode.style.display = 'none';
        });


        stage.on('contextmenu', function (e) {
            // prevent default behavior
            e.evt.preventDefault();
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