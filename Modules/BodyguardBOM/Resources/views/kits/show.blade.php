@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $kit->part_number ?? "no part number?" }}</h1>


    @includeIf('app.components.errors')
    <ul>


    <li class="row">
{{--        <div class="col-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h2>Categories--}}
{{--                        <a href="{{ route('bg.kits.categories.add', [$kit]) }}"--}}
{{--                            class="btn btn-success text-end"--}}
{{--                            >Add</a>--}}
{{--                    </h2>--}}
{{--                </div>--}}
{{--                <table class="table table-striped table-hover">--}}
{{--                    @foreach( $categories as $category )--}}
{{--                        <tr>--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('bg.categories.show', [$category])}}">--}}
{{--                                    {{ $category->name }}--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @if ( $categories->count() > 1 )--}}

{{--                                <form action="{{ route('bg.kits.categories.remove') }}" method="POST">--}}
{{--                                    @method("DELETE")--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" id="kit_id" value="{{ $kit->id }}" name="kit_id">--}}
{{--                                    <input type="hidden" id="category_id" value="{{ $category->id }}" name="category_id">--}}
{{--                                    <input type="submit" value="Remove" class="btn btn-danger">--}}
{{--                                </form>--}}
{{--                                    @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}
    </li>

    </ul>

@endsection