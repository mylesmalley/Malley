@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $category->name }}</h1>

    <ol>
        @foreach($category->ancestors as $anc)
        <lil>
            <a href="{{ route('bg.index.show', [$anc->id]) }}">
                {{ $anc->name }}
            </a>
        </lil>
            @endforeach
    </ol>

    <ul>
        @forelse( $category->children as $child )
            <li>
                <a href="{{ route('bg.index.show', [$child->id]) }}">
                    {{ $child->name }}
                </a>
            </li>
        @empty
            <li>No Children</li>
        @endforelse
    </ul>

    @if( ! $category->isRoot() )
        <form action="{{ route('bg.categories.store') }}" method="POST">
            @csrf
            <input type="hidden"
                   name="parent_id"
                   id="parent_id"
                   value="{{ $category->id }}">

            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            <label for="name">Category Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required>
            <input type="submit" value="Save">
        </form>
    @endif
@endsection
