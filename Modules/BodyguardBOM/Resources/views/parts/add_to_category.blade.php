@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Add {{ $part->part_number }} to another category</h1>
    @includeIf('app.components.errors')

    <form action="{{ route('bg.parts.categories.store') }}"
          method="POST"
          class="form">
        @csrf

        <input type="hidden"
               name="id"
               value="{{ $part->id }}"
               id="id">

        <div class="row">
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
                                {{ in_array($k, $existing_categories) ? "disabled" : "" }}

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