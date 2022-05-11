@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $category->name }}
    @if( !$category->isRoot() )
            <a href="{{ route('bg.categories.edit', [$category]) }}">[Edit]</a>
        @endif
    </h1>

    <div class="row">
        <ul>

        @foreach($category->ancestors as $anc)
            <li>
                <a href="{{ route('bg.categories.show', [$anc->id]) }}">
                    {{ $anc->name }}
                </a>
            </li>
            @endforeach
            <li>
                {{ $category->name }}
            </li>
        </ul>

    </div>




    <div class="row">
        <div class="col-9">
            @includeIf('bodyguardbom::categories.components.parts')
        </div>
        <div class="col"></div>
    </div>



    <hr />


    <div class="row">
        <div class="col-7">
            @includeIf('bodyguardbom::categories.components.sub_categories')
        </div>
        <div class="col-5">
            @includeIf('bodyguardbom::categories.components.add_category_component')
            <br>
            @if( !$category->children()->count() && !$category->parts->count() )
                @includeIf('bodyguardbom::categories.components.delete_category_component')
            @endif
        </div>

    </div>
@endsection
