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
                    <p>Based on your kit type, these are probably the components that will be part of it. You can add or remove afterwards if needed.</p>
                </div>
            </div>
        </div>
    </div>

    <br>



    @foreach($template['parts'] as $part)
        @includeIf('bodyguardbom::parts.component_partials.create_component_in_bulk', ['part' => $part] )
    @endforeach


@endsection

@push('scripts')
    <script>


{{--        let kit_codes = @json( $kit_codes );--}}

{{--        let colour_el = document.getElementById("colour");--}}
{{--        colour_el.addEventListener('change', generate_part_number);--}}

{{--        let roof_height_el = document.getElementById("roof_height");--}}
{{--        roof_height_el.addEventListener('change', generate_part_number);--}}

{{--        let kit_code_els = document.querySelectorAll('input[name="kit_code"]');--}}
{{--        kit_code_els.forEach(function(el){--}}
{{--            el.addEventListener('change', generate_part_number);--}}
{{--        });--}}

{{--        let chassis_el = document.getElementById("chassis");--}}
{{--        chassis_el.addEventListener('change', generate_part_number)--}}


{{--        let location_el = document.getElementById("location");--}}
{{--        location_el.addEventListener('change', generate_part_number)--}}


{{--        function generate_part_number()--}}
{{--        {--}}

{{--            let colour = colour_el.options[colour_el.selectedIndex].value;--}}
{{--            let colour_desc = colour_el.options[colour_el.selectedIndex].text;--}}

{{--            let roof_height = roof_height_el.options[roof_height_el.selectedIndex].value;--}}
{{--            let roof_height_desc = roof_height_el.options[roof_height_el.selectedIndex].text;--}}


{{--            let kit_code = document.querySelector('input[name="kit_code"]:checked')--}}
{{--                ? document.querySelector('input[name="kit_code"]:checked').value--}}
{{--                : "TRD";--}}

{{--            let kit_code_desc = kit_codes[kit_code]['desc'];--}}

{{--            let chassis = chassis_el.options[chassis_el.selectedIndex].value;--}}
{{--            let chassis_desc = chassis_el.options[chassis_el.selectedIndex].text;--}}

{{--            let location = location_el.options[location_el.selectedIndex].value;--}}
{{--            let location_desc = location_el.options[location_el.selectedIndex].text;--}}


{{--            let chassis_parent = document.querySelector('#chassis option:checked').parentElement.label;--}}


{{--            document.getElementById('part_number').value = `BGC_${kit_code}_${location}_${colour}_${chassis}${roof_height}`;--}}
{{--            let text_description = `A ${colour_desc} ${kit_code_desc} part for a ${roof_height_desc} ${chassis_desc} ${chassis_parent} at ${location_desc}`;--}}

{{--            document.getElementById('description').value = text_description.toUpperCase();--}}

{{--        }--}}


{{--        generate_part_number();--}}
    </script>
@endpush