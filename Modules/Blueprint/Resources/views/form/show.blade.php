@extends('blueprint::layouts.master')

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js')  }}"></script>

{{--    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>--}}
@endpush

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $form->name }}  test</h1>
            <h3 class="text-secondary">{{ $blueprint->name ?? 'Van' }}</h3>
        </div>
    </div>


    <div id="form_container"></div>

    <script>
        let form_data = {!! $form_data !!};
        let configuration = {!! $configuration !!};
        let elements = form_data["elements"];

        let blueprint_id = {{ $blueprint->id }};

        let form_container = document.getElementById('form_container');


        let build_form = new Promise(( resolve ) =>
        {
            elements.forEach(function( element ){

                switch (element.type ){

                    case "selection":
                        form_container.appendChild( create_checkbox_element( element ) );
                        break;
                    case "checklist":

                        break;
                    case "images":

                        break;
                    default:

                        break;
                }
            });
            resolve("Success!");  // Yay! Everything went well!
        });


        let refresh_selected_options = new Promise((resolve) => {

           for (let cfg in configuration)
           {
               let matching_element = document.getElementById( `option_${cfg}` );

               // highlight selected options
               if ( configuration[cfg]['value'] === "1" && matching_element )
               {
                   matching_element.classList.add('list-group-item-success');
               }

               // remove any options that should not be selected
               if ( configuration[cfg]['value'] === "0" && matching_element )
               {
                   matching_element.classList.remove('list-group-item-success');
               }
           }

            resolve("Success!");  // Yay! Everything went well!
        });


        build_form
            .then( () => refresh_selected_options )
            .then( () => {
                console.log("finished building teh form and updating it");
            })




        function create_checkbox_element( form_element )
        {
            let element_option_ids = [];

            // build the wrapper
            let container = document.createElement('div');
                container.classList.add('card','border-secondary', 'col-8','offset-2');

            // build the header row
            let header_div = document.createElement('div');
                header_div.classList.add('card-header','bg-secondary','text-white');
                header_div.innerHTML = `<h4>Select One: ${form_element.label}</h4>`

            // build the body list container
            let option_list = document.createElement('ul');
                option_list.classList.add('list-group','list-group-flush');

            form_element.items.forEach(function(item){
                // pull out the affected option ids
                element_option_ids.push( item.option.id );

                let opt = document.createElement('li');
                    opt.setAttribute('id', `option_${item.option.id}`);
                    opt.classList.add('list-group-item', 'list-group-item-action');
                    opt.innerHTML = `${item.option.option_description}`;

                    // handle click events and pass data to the handling functions.
                    opt.addEventListener('click', () => toggle( blueprint_id,  element_option_ids, [ item.option.id ] ) );

                option_list.appendChild( opt );
            });

            // add it all to the container and return
            container.appendChild( header_div );
            container.appendChild( option_list );

            return container;
        }

        function create_selection_element( form_element )
        {

        }




        function toggle(blueprint_id, options_to_turn_off, options_to_turn_on )
        {
            console.log('toggled',);

            // update the database
            console.log(blueprint_id, options_to_turn_off, options_to_turn_on );

            // update the local store
        }

    </script>



{{--    {{ dd( $form ) }}--}}
{{--        <livewire:blueprint::form.form-state--}}
{{--                :blueprint="$blueprint"--}}
{{--                :form="$form"--}}
{{--         />--}}


{{--    <livewire:blueprint::form.form-wrapper--}}
{{--            :blueprint="$blueprint"--}}
{{--            :form="$form"--}}
{{--     />--}}
{{--    @livewire("blueprint::form.form-wrapper", [$blueprint, $form], key('form-wrapper'.$form->id) )--}}
{{--{{ dd($form->elements) }}--}}

{{--    @foreach( $form->elements as $el)--}}
{{--        @php--}}
{{--            $element_options = $el->items->pluck('option_id')->toArray();--}}
{{--            $configurations =  array_intersect_key( $configuration, array_flip( $element_options ));--}}
{{--        @endphp--}}
{{--        --}}{{--           @if ($element->type === 'images')--}}
{{--        --}}{{--               @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,--}}
{{--        --}}{{--                                                    'element' => $element,--}}
{{--        --}}{{--                                                    'media' => $element->itemMedia()  ]  )--}}
{{--        --}}{{--            {{ dd( $el) }}--}}
{{--        --}}{{--            {{ dd( $el->items ) }}--}}
{{--        --}}{{--           @endif--}}

{{--        @if ($el->type === 'checklist')--}}
{{--            --}}{{----}}{{--            @livewire("blueprint::form.checklist", [  $el,array_intersect_key( $configuration, array_flip( $element_options ))  ], key('element-'.$el->id)  )--}}
{{--            <livewire:blueprint::form.checklist--}}
{{--                    :element="$el"--}}
{{--                    :configuration="$configurations"--}}
{{--                    wire:key="{{ $el->id }}" />--}}

{{--            --}}{{----}}{{--            @livewire("blueprint::form.checklist", [  $el,  $configuration  ], key('element-'.$el->id)  )--}}


{{--        @endif--}}
{{--        @if ($el->type === 'selection')--}}
{{--            --}}{{--               {{ dd($configuration, $element_options) }}--}}
{{--            --}}{{--            @livewire("blueprint::form.selection", [ $el,  array_intersect_key( $configuration, array_flip( $element_options ))  ], key('element-'.$el->id)   )--}}
{{--            <livewire:blueprint::form.checklist--}}
{{--                    :element="$el"--}}
{{--                    :configuration="$configurations"--}}
{{--                    wire:key="element-{$el->id}" />--}}
{{--            --}}{{--            @livewire("blueprint::form.selection", [  $el,  $configuration   ], key('element-'.$el->id)  )--}}
{{--        @endif--}}
{{--        <br>--}}
{{--    @endforeach--}}


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



        // Livewire.on('update-images', function(){
        //     update_drawings();
        //
        // });
        //
        // window.addEventListener('load', function() {
        //     update_drawings();
        // })
    </script>
    @endpush