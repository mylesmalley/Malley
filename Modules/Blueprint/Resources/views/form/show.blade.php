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
           @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,
                                                'element' => $element,
                                                'media' => $element->itemMedia()  ]  )

       @endif
       @if ($element->type === 'checklist')
           @livewire("blueprint::form.checklist", [ $blueprint, $element  ]  )
       @endif
       @if ($element->type === 'selection')
           @livewire("blueprint::form.selection", [ $blueprint, $element  ]  )
       @endif
       <br>
   @endforeach


{{--               @livewire("blueprint::form.active-drawings", [ $blueprint  ]  )--}}

    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>
    <br>



    <br><br>
@endsection

@push('scripts')
    <script>
        let stage_ids = [];

        function update_drawings()
        {
            fetch('{{ route('blueprint.drawings.activeDrawings', [$blueprint]) }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            }) .then(response => response.json())
                .then( function(data) {
                    console.log( data );


                    for (let i = 0; i < stage_ids.length; i++)
                    {
                        let shapes = eval( stage_ids[i] ).find('Image');
                        shapes.forEach( function(el){
                            el.hide();
                        });
                        // var shapes = stage174.find('Image');
                        // shapes.forEach( function(el){
                        //     el.hide();
                        // });
                    }




                    data.forEach( function( el ){
                        //    console.log( `option${el}` in window  );
                        //    console.log( `turn on option${el} ` )
                        if ( `option${el}` in window )
                        {
                            eval(`option${el}.show();`);

                            // console.log( `turned on "option" + ${el} ` )
                        }
                    });
                });

        }



        Livewire.on('update-images', function(){
            update_drawings();

        });

        window.addEventListener('load', function() {
            update_drawings();
        })
    </script>
    @endpush