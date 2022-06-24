@extends('bodyguardbom::layouts.master')

@section('content')

    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8 text-center">
            <h1>New Bodyguard Kit</h1>
            <h3 class="text-secondary ">Basic Details

            </h3>

        </div>
        <div class="col-2">
            <a class='btn btn-warning float-end'
               href="{{ route('bg.kits.home', ) }}">Cancel</a>
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
                    <p>This page helps you create a part number for a new Bodyguard Kit.
                        Simply choose from the menus below. As you make selections,
                        the part number will be generated at the bottom of the page.</p>
                </div>
            </div>
        </div>
    </div>



    <br>

    <div class="card-body">
        <form action="{{ route('bg.kits.store') }}"
              method="POST"
              class="form">



    <div class="row">
        <div class="col-12">
            <div class="card border-primary ">
                <div class="card-header bg-primary text-white">
                    Kit Details
                </div>
                <div class="card-body">


                        @csrf
                        <input type="hidden" value="BGK" name="category">





                        <div class="row">



                            <div class="col-3">

                                @error('chassis') <span class="text-danger">{{ $message }}</span> @enderror
                                <label for="chassis"
                                       class="form-label">
                                    Chassis &amp; chassis</label>
                                <select class="form-control"
                                        name="chassis"
                                        id="chassis">

                                    @foreach( $chassis as $van => $options )
                                        <optgroup label="{{ $van }}">
                                            @foreach( $options as $key => $desc)
                                                <option
                                                        {{ old('chassis', request()->input('chassis') ) == $key ? " selected " : ""   }}
                                                        value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                                            @endforeach
                                        </optgroup>



                                    @endforeach
                                </select>
                            </div>







                            <div class="col-2">
                                @error('colour') <span class="text-danger">{{ $message }}</span> @enderror
                                <label for="colour"
                                       class="form-label">
                                    Colour of Material</label>
                                <select class="form-control"
                                        name="colour"
                                        id="colour">
                                    @foreach( $colours as $k => $v )
                                        <option
                                                {{ old('colour', request()->input('colour')) === $k ? " selected " : ""   }}
                                                value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-2">
                                @error('roof_height') <span class="text-danger">{{ $message }}</span> @enderror
                                <label for="roof_height"
                                       class="form-label">
                                    Roof Height</label>
                                <select class="form-control"
                                        name="roof_height"
                                        id="roof_height">
                                    @foreach( $roof_heights as $k => $v )
                                        <option
                                                {{ old('roof_height', request()->input('roof_height')) === $k ? " selected " : ""   }}
                                                value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                </div>


            </div>
                </div>
            </div>



        <br>

        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h5>Type of Product</h5>
            </div>
            <table class="table table-striped">


            @foreach( $kit_codes as $k => $v )
                <tr>
                    <td>

                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           required
                           {{ old('kit_code', request()->input('kit_code')) === $k ? " checked " : ""   }}
                           name="kit_code"
                           value="{{ $k }}"
                           id="kit_code{{ $k }}">
                    <label class="form-check-label" for="kit_code{{ $k }}">
                        <strong>
                            {{ $v['desc'] }}
                        </strong>
                        <br>
                        {{ $v['ext'] }}
                    </label>
                </div>
                    </td>

                </tr>

                @endforeach

            </table>
        </div>


            <br>


    <div class="row">
        <div class="col-12">

            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    What's being created
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            @error('part_number') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="part_number"
                                   class="form-label">
                                Part Number</label>
                            <input type="text"
                                   class="form-control"
                                                      readonly
                                   id="part_number"
                                   name="part_number"
                                   value="{{ old('part_number') }}"
                                   placeholder="PART NUMBER">
                        </div>

                        <div class="col-12">
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror

                            <label for="description"
                                   class="form-label">
                                Description</label>
                            <input type="text"
                                   class="form-control"
                                   id="description"
                                   name="description"
                                   value="{{ old('description') }}"
                                   placeholder="Description">
                        </div>

                    </div>
                    <br>
                    <div class="row">

                        <div class="col-3">
                            <input type="submit" value="Save" class="btn btn-success">
                        </div>

                    </div>
                </div>
            </div>

        </div>




    </div>






    </form>


@endsection

@push('scripts')
    <script>


        let kit_codes = @json( $kit_codes )

        let colour_el = document.getElementById("colour");
        colour_el.addEventListener('change', generate_part_number);

        let roof_height_el = document.getElementById("roof_height");
        roof_height_el.addEventListener('change', generate_part_number);

        let kit_code_els = document.querySelectorAll('input[name="kit_code"]');
        kit_code_els.forEach(function(el){
            el.addEventListener('change', generate_part_number);
        });

        let chassis_el = document.getElementById("chassis");
        chassis_el.addEventListener('change', generate_part_number)

        function generate_part_number()
        {

            let colour = colour_el.options[colour_el.selectedIndex].value;
            let colour_desc = colour_el.options[colour_el.selectedIndex].text;

            let roof_height = roof_height_el.options[roof_height_el.selectedIndex].value;
            let roof_height_desc = roof_height_el.options[roof_height_el.selectedIndex].text;


            let kit_code = document.querySelector('input[name="kit_code"]:checked')
                ? document.querySelector('input[name="kit_code"]:checked').value
                : "C1D";

            let kit_code_desc = kit_codes[kit_code]['desc'];

            let chassis = chassis_el.options[chassis_el.selectedIndex].value;
            let chassis_desc = chassis_el.options[chassis_el.selectedIndex].text;

            let chassis_parent = document.querySelector('#chassis option:checked').parentElement.label;


            document.getElementById('part_number').value = `BGK_${kit_code}_${colour}_${chassis}${roof_height}`;
            let text_description = `A ${colour_desc} ${kit_code_desc} kit for a ${roof_height_desc} ${chassis_desc} ${chassis_parent}`;

            document.getElementById('description').value = text_description.toUpperCase();

        }


        generate_part_number();
    </script>
@endpush