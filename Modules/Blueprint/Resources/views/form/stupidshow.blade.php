@extends('blueprint::layouts.master')

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js')  }}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $form->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->name ?? 'Van' }}</h3>
        </div>
    </div>



   @foreach( $form->elements as $element )

       @if ($element->type === 'images')
{{--           @livewire("blueprint::form.image", [ $blueprint, $element  ]  )--}}


                <div id="container"></div>
@push('scripts')
                    <script>
                        // window.addEventListener('load', function (){
                      //  console.error( Konva );

                        var stage = new Konva.Stage({
                            container: 'container',   // id of container <div>
                            width: 500,
                            height: 500
                        });

                        // then create layer
                        var layer = new Konva.Layer();

                        // create our shape
                        var circle = new Konva.Circle({
                            x: stage.width() / 2,
                            y: stage.height() / 2,
                            radius: 70,
                            fill: 'red',
                            stroke: 'black',
                            strokeWidth: 4
                        });

                        // add the shape to the layer
                        layer.add(circle);

                        // add the layer to the stage
                        stage.add(layer);

                        // draw the image
                        layer.draw();


                    </script>
@endpush



       @endif

   @endforeach


@endsection
