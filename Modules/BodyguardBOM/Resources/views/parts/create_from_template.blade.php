@extends('bodyguardbom::layouts.master')

@section('content')

    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8 text-center">
            <h1>Create Components</h1>
            <h3 class="text-secondary ">Template

            </h3>

        </div>
        <div class="col-2">
            <a class='btn btn-warning float-end'
               href="{{ route('bg.parts.home' ) }}">Cancel</a>
        </div>
    </div>



    @includeIf('app.components.errors')

    <div class="row">
        <div class="offset-2 col-8">
            <div class="card border-info">
                <div class="card-header bg-info">
                    Instructions
                </div>
                <div class="card-body">
                    <p>Based on your kit type, these are <b>probably</b> the components that will be part of it. You can add or remove afterwards if needed. You can skip this step entirely if you prefer and get back to this page by editing a kit's components. </p>
                    <p>Next to each suggested component is the option to include it or not. If you do not need a part, answer no. </p>
                    <p>As you configure the component, the system will check if it exists already. If so, it will be added automatically to the kit. If it does not exist, it will be created for you. You will still need to add parts to the components that are created.</p>
                </div>
            </div>
        </div>
    </div>

    <br>


    @push('scripts')
        <script>
            let kit_codes = @json( $kit_codes );
        </script>
@endpush
    <form method="POST"
          action="{{ route('bg.kits.store_bulk_components', $kit) }}">
        @csrf
            @forelse($template['parts'] as $part)
                @includeIf('bodyguardbom::parts.component_partials.create_component_in_bulk', [
                    'part' => $part,
                    'id' => $loop->index
                ])
            <br>


                @push('scripts')
                    <script>

                        let colour_el_{{ $loop->index }} = document.getElementById("colour_{{ $loop->index }}");
                        colour_el_{{ $loop->index }}.addEventListener('change', generate_part_number_{{ $loop->index }});
    
                        let roof_height_el_{{ $loop->index }} = document.getElementById("roof_height_{{ $loop->index }}");
                        roof_height_el_{{ $loop->index }}.addEventListener('change', generate_part_number_{{ $loop->index }});

                        let kit_code_el_{{ $loop->index }} = document.getElementById("kit_code_{{ $loop->index }}");
                        kit_code_el_{{ $loop->index }}.addEventListener('change', generate_part_number_{{ $loop->index }});


                        {{--let kit_code_els_{{ $loop->index }} = document.querySelectorAll('input[id="kit_code_{{ $loop->index }}"]');--}}
                        {{--kit_code_els_{{ $loop->index }}.forEach(function(el){--}}
                        {{--    el.addEventListener('change', generate_part_number_{{ $loop->index }});--}}
                        {{--});--}}
    
                        let chassis_el_{{ $loop->index }} = document.getElementById("chassis_{{ $loop->index }}");
                        chassis_el_{{ $loop->index }}.addEventListener('change', generate_part_number_{{ $loop->index }})
    
    
                        let location_el_{{ $loop->index }} = document.getElementById("location_{{ $loop->index }}");
                        location_el_{{ $loop->index }}.addEventListener('change', generate_part_number_{{ $loop->index }})
    
    
                        function generate_part_number_{{ $loop->index }}()
                        {
    
                            let colour = colour_el_{{ $loop->index }}
                                .options[colour_el_{{ $loop->index }}.selectedIndex].value;
                            let colour_desc = colour_el_{{ $loop->index }}
                                .options[colour_el_{{ $loop->index }}.selectedIndex].text;
    
                            let roof_height = roof_height_el_{{ $loop->index }}
                                .options[roof_height_el_{{ $loop->index }}.selectedIndex].value;
                            let roof_height_desc = roof_height_el_{{ $loop->index }}
                                .options[roof_height_el_{{ $loop->index }}.selectedIndex].text;


                            let kit_code = kit_code_el_{{ $loop->index }}
                                .options[kit_code_el_{{ $loop->index }}.selectedIndex].value;
                            let kit_code_desc = kit_code_el_{{ $loop->index }}
                                .options[kit_code_el_{{ $loop->index }}.selectedIndex].text;

                            
                            {{--let kit_code = document.querySelector('#kit_code_{{ $loop->index }} option:checked')--}}
                            {{--    ? document.querySelector('#kit_code_{{ $loop->index }} option:checked').value--}}
                            {{--    : "TRD";--}}
    
                          //  let kit_code_desc = kit_codes[kit_code]['desc'];
    
                            let chassis = chassis_el_{{ $loop->index }}
                                .options[chassis_el_{{ $loop->index }}.selectedIndex].value;
                            let chassis_desc = chassis_el_{{ $loop->index }}
                                .options[chassis_el_{{ $loop->index }}.selectedIndex].text;
    
                            let location = location_el_{{ $loop->index }}
                                .options[location_el_{{ $loop->index }}.selectedIndex].value;
                            let location_desc = location_el_{{ $loop->index }}
                                .options[location_el_{{ $loop->index }}.selectedIndex].text;
    
    
                            let chassis_parent = document.querySelector('#chassis_{{ $loop->index }} option:checked').parentElement.label;
    

                            let assembled_part_number = `BGC_${kit_code}_${location}_${colour}_${chassis}${roof_height}`;

                            document.getElementById('part_number_{{ $loop->index }}').value = assembled_part_number;
                            let text_description = `A ${colour_desc} ${kit_code_desc} part for a ${roof_height_desc} ${chassis_desc} ${chassis_parent} at ${location_desc}`;
    
                            document.getElementById('description_{{ $loop->index }}').value = text_description.toUpperCase();



                            fetch(`{{ route("bg.kits.check_if_part_exists") }}?part_number=${assembled_part_number}`,
                                {
                                    method: "GET",
                                }).then(function( response ){
                            return response.json();
                        }).then(function(res){
                                console.log( res );
                                let status_block = document.getElementById('status_{{ $loop->index }}');
                                if (res === true)
                                {
                                    status_block.innerHTML = "Already created.";

                                } else {
                                    status_block.innerHTML = "Will be created";

                                }


                            }).catch( function(){
                                console.log('error')
                        });














                        }
    
    
                        generate_part_number_{{ $loop->index }}();
                    </script>
                @endpush

            @empty
                Sorry, but no template exists for this yet.
            @endforelse
        <input class="btn btn-success" type="submit">
        <br>

        <a class="btn btn-warning" href="{{ route('bg.kits.show', $kit) }}">Skip This Step</a>
    </form>



@endsection

