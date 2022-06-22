@extends('bodyguardbom::layouts.master')

@section('content')


    <div class="row">
        <div class="col-12 text-center">
            <h1>{{ $kit->part_number ?? "No part number selected?" }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 text-primary">
                            Description
                        </div>
                        <div class="col-10">
                            {{ $kit->description }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-6">
            @includeIf('bodyguardbom::kits.home_page_sections.syspro_components' )
        </div>
    </div>
    


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