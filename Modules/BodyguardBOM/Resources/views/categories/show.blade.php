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

    <ul>
        @forelse( $category->children as $child )
            <li>
                <a href="{{ route('bg.categories.show', [$child->id]) }}">
                    {{ $child->name }}
                </a>
            </li>
        @empty
            <li>No Children <br>


            </li>
        @endforelse
    </ul>

    <div class="row">
        <div class="col-5">
            @includeIf('bodyguardbom::categories.components.add_category_component')
        </div>
        @if( !$category->children()->count() )
            <div class="col-3">
                @includeIf('bodyguardbom::categories.components.delete_category_component')
            </div>
        @endif
    </div>
@endsection
