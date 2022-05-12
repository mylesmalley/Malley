@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>New Part</h1>
    @includeIf('app.components.errors')

    <form action="{{ route('bg.parts.store') }}"
          method="POST"
        class="form">
        @csrf

        <div class="row">



        <div class="col-3">
            @error('part_number') <span class="text-danger">{{ $message }}</span> @enderror

            <label for="part_number"
                   class="form-label">
                Part Number</label>
            <input type="text"
                   class="form-control"
                   id="part_number"
                   name="part_number"
                   value="{{ old('part_number') }}"
                   placeholder="PART NUMBER">
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
                                {{ old('roof_height') === $k ? " selected " : ""   }}
                                value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>

        </div>


        <div class="row">

            <div class="col-3">
                <input type="submit" value="Save" class="btn btn-success">
            </div>

        </div>



    </form>


@endsection