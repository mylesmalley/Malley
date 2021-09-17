@extends('blueprint::layouts.master')

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js')  }}"></script>
{{--    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>--}}
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
           @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,
                                                'element' => $element,
                                                'media' => $element->itemMedia()  ]  )

{{--<div class="row">--}}
{{--    <div class="col-8 offset-2">--}}
{{--        <div class="card border-primary  ">--}}
{{--            --}}{{--            <div class="card-header text-white bg-secondary">--}}
{{--            --}}{{--                <h4 class="">{{ $element->label }}</h4>--}}
{{--            --}}{{--            </div>--}}
{{--            <div class="card-body bg-secondary">--}}

{{--                <div id="container"></div>--}}
{{--@push('scripts')--}}
{{--                    <script>--}}
{{--                        // window.addEventListener('load', function (){--}}
{{--                      //  console.error( Konva );--}}

{{--                        var stage = new Konva.Stage({--}}
{{--                            container: 'container',   // id of container <div>--}}
{{--                            width: 500,--}}
{{--                            height: 500--}}
{{--                        });--}}

{{--                        // then create layer--}}
{{--                        var layer = new Konva.Layer();--}}

{{--                        // create our shape--}}
{{--                        var circle = new Konva.Circle({--}}
{{--                            x: stage.width() / 2,--}}
{{--                            y: stage.height() / 2,--}}
{{--                            radius: 70,--}}
{{--                            fill: 'red',--}}
{{--                            stroke: 'black',--}}
{{--                            strokeWidth: 4--}}
{{--                        });--}}

{{--                        // add the shape to the layer--}}
{{--                        layer.add(circle);--}}

{{--                        // add the layer to the stage--}}
{{--                        stage.add(layer);--}}

{{--                        // draw the image--}}
{{--                        layer.draw();--}}


{{--                    </script>--}}
{{--@endpush--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



       @endif
       @if ($element->type === 'checklist')
           @livewire("blueprint::form.checklist", [ $blueprint, $element  ]  )
       @endif
       @if ($element->type === 'selection')
           @livewire("blueprint::form.selection", [ $blueprint, $element  ]  )
       @endif
       <br>
   @endforeach


               @livewire("blueprint::form.active-drawings", [ $blueprint  ]  )

    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>
    <br>



{{--    <div class="row">--}}
{{--        <div class="col-6 offset-3">--}}
{{--            @livewire("blueprint::question", ['blueprint'=>$blueprint, 'wizard'=>$wizard ]  )--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <div class="row">--}}
{{--        <div class="col-10 offset-1">--}}
{{--            @livewire("blueprint::progress", ['blueprint'=>$blueprint,  'wizard'=>$wizard  ] )--}}
{{--        </div>--}}
{{--    </div>--}}

    <br><br>
@endsection

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        // window.addEventListener('load', function(){--}}
{{--        //     setTimeout(1000, function(){--}}
{{--        //         Livewire.emit('postAdded');--}}
{{--        //--}}
{{--        //     })--}}
{{--        // });--}}



{{--    </script>--}}
{{--    @endpush--}}