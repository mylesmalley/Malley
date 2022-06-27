@extends('bodyguardbom::layouts.master')

@section('content')



    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8 text-center">
            <h1>{{ $kit->part_number ?? "No part number selected?" }}</h1>
            @if ( $kit->category === "BGC")
                <h3 class="text-secondary ">
                    Kit Part
                </h3>
            @endif
            @if ( $kit->category === "BGK")
                <h3 class="text-secondary ">
                    Kit
                </h3>
            @endif

            <br>

        </div>
        <div class="col-2">

        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <a class="btn btn-primary"
               href="{{ route('bg.kits.home') }}">Bodyguard Kits Index</a>
            <a class="btn btn-secondary"
               href="{{ route('bg.parts.home') }}">Bodyguard Parts Index</a>
        </div>
    </div>
    <br>




    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2 text-primary">
                            Description
                        </div>
                        <div class="col-6">
                            {{ $kit->description }}
                        </div>
                        <div class="col-4">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Kits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chassis</td>
                                        <td>{{ $chassis }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-6">
            @includeIf('bodyguardbom::kits.component_partials.syspro_components' )
        </div>


        @if( $kit->category === "BGC"  && isset( $where_used  ) )
            <div class="col-6">
                <div class="card border-secondary">
                    <div class="card-header bg-secondary text-white">
                        Kits Using This Part
                    </div>
                    <table class="table table-striped">
                        @foreach( $where_used as $wu )
                            <tr onclick="location.href = '{{ route('bg.kits.show', $wu) }}'">
                                <td>
                                    <strong>
                                        {{ $wu->part_number }}
                                    </strong> <br>
                                    {{ $wu->description }}
                                    </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
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