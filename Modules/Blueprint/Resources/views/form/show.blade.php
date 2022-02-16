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

    @livewire("blueprint::form.form-wrapper", [$blueprint, $form]  )





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
        // array of stage ids to handle forms with multiple
        let stage_ids = [];

        function update_drawings()
        {

            // gets the ids of images that should be turned on...
            fetch('{{ route('blueprint.drawings.activeDrawings', [$blueprint]) }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            }) .then(response => response.json())
                .then( function(data) {
              //      console.log( data );

                    // loop through the window's stages and turn off all their children elements.
                    for (let i = 0; i < stage_ids.length; i++)
                    {
                        let shapes = eval( stage_ids[i] ).find('Image');
                        shapes.forEach( function(el){
                            el.hide();
                        });
                    }



                    // turn on the images required
                    data.forEach( function( el ){

                        if ( `option${el}` in window )
                        {
                            eval(`option${el}.show();`);
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