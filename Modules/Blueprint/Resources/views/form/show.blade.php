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
        let active_option_names_for_rules = [];


        let elements = form_data["elements"];
        let blueprint_id = {{ $blueprint->id }};
        let form_container = document.getElementById('form_container');


        // loops through the configuration and pulls out the names of active options
        function get_option_names_for_rule_comparison()
        {
            return new Promise((resolve) => {
                for (let cfg in configuration)
                {
                    if ( configuration[cfg]['value'] === "1")
                    {
                        active_option_names_for_rules.push(configuration[cfg]["name"]);
                    }
                }
                resolve('filtered the rules out');
            });
        }

        function build_form()
        {
            return new Promise(( resolve ) =>
            {
                elements.forEach(function( element ){

                    switch (element.type ){

                        case "selection":
                            form_container.appendChild( create_form_element( element ) );
                            break;
                        case "checklist":
                            form_container.appendChild( create_form_element( element ) );
                            break;
                        case "images":

                            break;
                        default:

                            break;
                    }
                });
                resolve("Success!");  // Yay! Everything went well!
            });
        }


        function refresh_selected_options()
        {
            return new Promise((resolve) => {

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
        }



        /**
         * loops through the form elements and hides or shows
         * them based on the array of affected options and rules
         */
        function update_form_element_visibility()
        {
            return new Promise((resolve) => {
                let elements = document.getElementsByClassName('form-element-question');

                // loop through each form element
                for (let i = 0; i < elements.length; i++)
                {
                    // convert the rules into an array
                    let element_rules = JSON.parse( elements[i].dataset.rules );

                    // force the element to be visible first...
                    elements[i].classList.remove('d-none');

                    // if the element has rules
                    if ( element_rules.length )
                    {
                        // compare the intersection of the element's rules to the active option names on the blueprint
                        let intersection = element_rules.filter(x => active_option_names_for_rules.includes(x));

                        // if there is no overlap, flag
                        if ( !intersection.length )
                        {
                            elements[i].classList.add('d-none');
                        }
                        else
                        {
                            // if there is overlap, show it.
                            elements[i].classList.remove('d-none');
                        }
                    }
                }

                resolve( "updated visibility" );
            });
        }



        /**
         * Builds the DOM for a form element
         */
        function create_form_element( form_element )
        {
            let element_option_ids = [];

            let element_rule_option_names = ( form_element.rule )
                ? form_element.rule.options
                : "[]";

            // build the wrapper
            let container = document.createElement('div');
                container.classList.add(
                    'card','border-secondary',
                    'col-8','offset-2',
                    'form-element-question', // used by the rules checker
                    'mb-2' // bootstrap helper class that adds margin below the element
                );

                // add the array of rules to keep an eye out on
                container.dataset.rules =  element_rule_option_names ;

            // build the header row
            let header_div = document.createElement('div');
                header_div.classList.add('card-header','bg-secondary','text-white' );

                if (form_element.type === "selection")
                {
                    header_div.innerHTML = `<h4>Select One: ${form_element.label}</h4>`
                }
                else
                {
                    header_div.innerHTML = `<h4>${form_element.label}</h4>`
                }

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
                    opt.addEventListener('click', function(){

                        // fire off chain of events to update the database and local form state
                        if (form_element.type === "selection")
                        {
                            // selections require other options to be disabled
                            toggle_selection( blueprint_id,  element_option_ids, [ item.option.id ] )
                                .then( refresh_selected_options )
                                .then( update_form_element_visibility );
                        }
                        else
                        {
                            // checkboxes can have multiples or none
                            toggle_checkbox( blueprint_id,  item.option.id )
                                .then( refresh_selected_options )
                                .then( update_form_element_visibility );
                        }
                    });

                option_list.appendChild( opt );
            });

            // add it all to the container and return
            container.appendChild( header_div );
            container.appendChild( option_list );

            return container;
        }



        /**
         * accepts a blueprint and affected options and returns
         * a promise that the changes have actually been posted.
         *
         * @param blueprint_id
         * @param options_to_turn_off
         * @param options_to_turn_on
         * @returns {Promise<unknown>}
         */
        function toggle_selection(blueprint_id, options_to_turn_off, options_to_turn_on )
        {
            return new Promise( (resolve, reject) => {
                // update the database
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "{{ route('blueprint.form.toggle_selection', [$blueprint]) }}" );
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                    blueprint_id,
                    options_to_turn_off,
                    options_to_turn_on,
                }));

                xhr.error = function(){
                    reject("failed to update blueprint database");
                }

                // update the local store
                options_to_turn_off.forEach(function(el){
                    configuration[el]['value'] = "0";

                    // remove the rule names from the active options array
                    let option_name = configuration[el]['name'];
                    let index = active_option_names_for_rules.indexOf(option_name);
                    if (index !== -1) {
                        active_option_names_for_rules.splice(index, 1);
                    }
                });

                options_to_turn_on.forEach(function(el){
                    configuration[el]['value'] = "1";

                    // add the names to the rule array
                    let option_name = configuration[el]['name'];
                    active_option_names_for_rules.push( option_name );
                });

                resolve('success');
            });

        }


        /**
         * toggles the value of a checkbox on the client and server side.
         * @param blueprint_id
         * @param option_id
         * @returns {Promise<unknown>}
         */
        function toggle_checkbox( blueprint_id, option_id )
        {
            return new Promise( (resolve, reject) => {
                // update the database
                let xhr = new XMLHttpRequest();

                xhr.open("POST", "{{ route('blueprint.form.toggle_checkbox', [$blueprint]) }}" );
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify({
                    "_token": "{{ csrf_token() }}",
                    blueprint_id,
                    option_id,
                }));

                xhr.error = function(){
                    reject("failed to update blueprint database");
                }

                let option_name = configuration[option_id]['name'];

                // because why the hell not.
                configuration[option_id]['value'] = (
                    configuration[option_id]['value'] === "0") ? "1" : "0";

                // remove active option name from array for rules handling
                if ( configuration[option_id]['value'] === "1" ) {
                    let index = active_option_names_for_rules.indexOf(option_name);
                    if (index !== -1) {
                        active_option_names_for_rules.splice(index, 1);
                    }
                }

                // add reference to the array of active options for rule handling
                if ( configuration[option_id]['value'] === "0" ) {
                    active_option_names_for_rules.push( option_name );
                }

                resolve('success');
            });
        }



        // first run through on page load
        get_option_names_for_rule_comparison()
            // create the elements required
            .then( build_form )
            // updates the local state of the form to reflect the database
            .then( refresh_selected_options )
            // hides elements that don't pass rules.
            .then( update_form_element_visibility );


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