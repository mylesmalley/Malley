<script>
    const width = 1100;
    const height = 450;
    const GRID_SIZE = 10;

    let stage = new Konva.Stage({
        container: 'konvaStage',
        width: width,
        height: height,
    });

    let floorLayer = new Konva.Layer();
    stage.add(floorLayer);

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


    let preset;

    @if( $blueprint->custom_layout )
        preset = {!!  $blueprint->custom_layout  !!};
    @endif

    if ( preset )
    {
        for (let i = 0; i < preset.children.length; i++ )
        {
            add_image(  preset.children[i].attrs.grouping, preset.children[i].attrs.x, preset.children[i].attrs.y )
        }
    }
</script>