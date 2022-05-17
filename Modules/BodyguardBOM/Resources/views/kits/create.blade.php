@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>New Part</h1>
    @includeIf('app.components.errors')

    <form action="{{ route('bg.kits.store') }}"
          method="POST"
        class="form">
        @csrf

        <div class="row">



    <div class="col-3">

            @error('wheelbase') <span class="text-danger">{{ $message }}</span> @enderror
            <label for="wheelbase"
                   class="form-label">
                Roof Height</label>
            <select class="form-control"
                    name="wheelbase"
                    id="wheelbase">

                @foreach( $wheelbases as $van => $options )
                    <optgroup label="{{ $van }}">
                        @foreach( $options as $key => $desc)
                            <option
                                  {{ old('wheelbase', request()->input('wheelbase') ) == $key ? " selected " : ""   }}
                                    value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                        @endforeach
                    </optgroup>



                @endforeach
            </select>
        </div>




        <div class="col-3">
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

        <div class="col-3">
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
            <label for="category_id"
                   class="form-label">
                Category</label>
            <select class="form-control"
                    name="category_id"
                    id="category_id">
                @foreach( $tree as $k => $v )



                    <option
                            {{ $category && $category === $k ? " selected " : ""   }}
                            value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </div>

        </div>


        <div class="row">

            <div class="col-2">
                @error('prefix') <span class="text-danger">{{ $message }}</span> @enderror
                <label for="prefix"
                       class="form-label">
                    Category</label>
                <select class="form-control"
                        name="prefix"
                        id="prefix">
                    @foreach( $prefixes as $k => $v )
                        <option
                            {{ old('prefix') === $k ? " selected " : ""   }}
                            value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>



            <div class="col-2">
                @error('colour') <span class="text-danger">{{ $message }}</span> @enderror
                <label for="colour"
                       class="form-label">
                    Colour</label>
                <select class="form-control"
                        name="colour"
                        id="colour">
                    @foreach( $colours as $k => $v )
                        <option
                                {{ old('colour') === $k ? " selected " : ""   }}
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


        <div class="card">
            <div class="card-header">
                <h5>Type of Product</h5>
            </div>
        <table class="table table-striped">


        @foreach( $kit_codes as $k => $v )
            <tr>
                <td>

            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
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



    <div class="row">
        <div class="col-8">
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
    </div>

    <div class="row">

            <div class="col-3">
                <input type="submit" value="Save" class="btn btn-success">
            </div>

        </div>



    </form>


@endsection

@push('scripts')
    <script>
        function generate_part_number()
        {

            let prefix_el = document.getElementById("prefix");
            prefix_el.addEventListener('change', generate_part_number)
            let prefix = prefix_el.options[prefix_el.selectedIndex].value;

            let colour_el = document.getElementById("colour");
            colour_el.addEventListener('change', generate_part_number);
            let colour = colour_el.options[colour_el.selectedIndex].value;

            let roof_height_el = document.getElementById("roof_height");
            roof_height_el.addEventListener('change', generate_part_number);
            let roof_height = roof_height_el.options[roof_height_el.selectedIndex].value;


            let kit_code_els = document.querySelectorAll('input[name="kit_code"]');
            kit_code_els.forEach(function(el){
                el.addEventListener('change', generate_part_number);
            });
            let kit_code = document.querySelector('input[name="kit_code"]:checked').value ?? "C1D";

            let wheelbase_el = document.getElementById("wheelbase");
            wheelbase_el.addEventListener('change', generate_part_number)
            let wheelbase = wheelbase_el.options[wheelbase_el.selectedIndex].value;



            document.getElementById('part_number').value = `${prefix}_${kit_code}_${colour}_${wheelbase}${roof_height}`;
        }


        generate_part_number();
    </script>
@endpush