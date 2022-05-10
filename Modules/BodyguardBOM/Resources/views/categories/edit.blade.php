@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Editing "{{ $category->name }}"</h1>


    <form action="{{ route('bg.categories.update') }}" method="POST">
        @csrf
        <input type="hidden"
               value="{{ $category->id }}"
               name="id"
               id="id">

        @method('PATCH')
        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        <label for="name">Change name to </label>
        <input type="text"
               class="form-control"
               name="name"
               id="name"
               value="{{ old('name', $category->name) }}">
        <input type="submit"
               value="Save"
               class="btn btn-primary"
               name="submit"
               id="submit">
    </form>
@endsection
