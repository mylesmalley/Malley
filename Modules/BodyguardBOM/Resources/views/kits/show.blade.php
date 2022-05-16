@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $part->part_number }}</h1>
    @includeIf('app.components.errors')
    <ul>


    <li class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h2>Categories
                        <a href="{{ route('bg.parts.categories.add', [$part]) }}"
                            class="btn btn-success text-end"
                            >Add</a>
                    </h2>
                </div>
                <table class="table table-striped table-hover">
                    @foreach( $categories as $category )
                        <tr>
                            <td>
                                <a href="{{ route('bg.categories.show', [$category])}}">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td>
                                @if ( $categories->count() > 1 )

                                <form action="{{ route('bg.parts.categories.remove') }}" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <input type="hidden" id="part_id" value="{{ $part->id }}" name="part_id">
                                    <input type="hidden" id="category_id" value="{{ $category->id }}" name="category_id">
                                    <input type="submit" value="Remove" class="btn btn-danger">
                                </form>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </li>

    </ul>

@endsection