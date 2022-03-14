@extends('blueprint::layouts.master')

@push('header_scripts')
    <script src="https://unpkg.com/konva@8/konva.min.js"></script>
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

        let media = @json( $media );
        let form_container = document.getElementById('form_container');

        let image_objects = [];

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

        /**
         * loops through the form elements and handles them depending on their type.
         * @returns {Promise<unknown>}
         */
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
                            create_image_block( element )
                                .then( instantiate_konva_canvas );
                            break;
                        default:

                            break;
                    }
                });
                resolve("Success!");  // Yay! Everything went well!
            });
        }


        /**
         * updates the local state of the form
         * @returns {Promise<unknown>}
         */
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
        function update_form_element_visibility(  first_run_on_page_load = false  )
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

                            // turn off options that are hidden on the form, even accidentally.
                            if ( first_run_on_page_load === false)
                            {
                                toggle_selection( blueprint_id, JSON.parse( elements[i].dataset.element_option_ids ), []);
                            }
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
         * builds the DOM for the image blocks for the form
         * @param form_element
         * @returns {Promise<unknown>}
         */
        function create_image_block( form_element )
        {

            return new Promise( (resolve) => {

                let container = document.createElement('div');
                    container.classList.add(
                        'card','border-dark','bg-light',
                        'col-10','offset-1',
                        'form-image-block', // used by the rules checker
                        'mb-2' // bootstrap helper class that adds margin below the element
                    );

                let image_block_id = `image_${form_element.id}`;

                let body = document.createElement('div');
                    body.classList.add(
                        'card-body',
                        'bg-light'
                    );
                    body.innerHTML = 'hello world';
                    body.setAttribute('id', image_block_id )

                container.appendChild( body );
                    let footer = document.createElement('div');
                        footer.classList.add('card-footer','text-center');
                        footer.innerHTML = form_element.label + " View" ;


                container.appendChild( footer );
                container.appendChild( footer );


                form_container.appendChild( container );

                resolve( image_block_id );
            });

        }


        /**
         * once the dom has been updated with divs to hold them, this creates the konva objects to render the canvases.
         */
        function instantiate_konva_canvas( image_block_id )
        {

            let images = media[image_block_id];

            // set the dimensions from the first element of the images from the media list
            let konva = new Konva.Stage({
                container: image_block_id,
                width: images[0][2],
                height: images[0][3],
            });


            let layer = new Konva.Layer();
            konva.add( layer );

            images.forEach(function(item) {
                Konva.Image.fromURL( item[1], function (image ) {
                    image.id( `image_${item[0]}` );
                    image.setAttr('option_id', item[0] );

                    image_objects.push( image );

                    // when first loading, determines if the image should be shown or not.
                    if ( configuration[item[0]] && configuration[item[0]]["value"] === "1")
                    {
                        image.visible( true );
                    }
                    else
                    {
                        image.visible( false );
                    }
                    layer.add(image);
                });
            });

        }


        // runs through the image blocks and checks if they should be visible or not
        function update_image_blocks()
        {
            image_objects.forEach( function( image ) {

                if ( configuration[ image.getAttr('option_id') ] &&
                    configuration[ image.getAttr('option_id') ]["value"] === "1")
                {
                    image.visible( true );
                }
                else
                {
                    image.visible( false );
                }
            });
        }

        /**
         * Builds the DOM for a form element
         */
        function create_form_element( form_element )
        {
            // this gets populated as the form loads and added to the element's dataset
            let element_option_ids = [];

            // array ends up being stringy json
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
                                .then( update_form_element_visibility )
                                .then( update_image_blocks );
                        }
                        else
                        {
                            // checkboxes can have multiples or none
                            toggle_checkbox( blueprint_id,  item.option.id )
                                .then( refresh_selected_options )
                                .then( update_form_element_visibility )
                                .then( update_image_blocks );
                        }
                    });

                option_list.appendChild( opt );
            });

            // add it all to the container and return
            container.appendChild( header_div );
            container.appendChild( option_list );


            // set the options on the element aside in case the element is hidden. then they should all be turned off.
            container.dataset.element_option_ids = (element_option_ids.length)
                ? JSON.stringify( element_option_ids )
                : "[]" ;

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
                    location.reload();
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
                    location.reload();
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
        get_option_names_sfor_rule_comparison()
            // create the elements required
            .then( build_form )
            // updates the local state of the form to reflect the database
            .then( refresh_selected_options )
            // hides elements that don't pass rules.
            .then( update_form_element_visibility(true) );

    </script>


    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>
    <br>



    <br><br>
@endsection

