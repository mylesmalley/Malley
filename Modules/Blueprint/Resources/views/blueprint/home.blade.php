@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->platform->name ?? 'Van' }}</h3>
        </div>
    </div>



    @includeIf('blueprint::blueprint.home_components.about')

    <br>


    <div class="row">
        <div class="col-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Drawing Package
                </div>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.drawings.generate', [$blueprint]) }}">Get Drawing Package</a>
                </div>
            </div>
        </div>


        <div class="col-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Quotes
                </div>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.quote', [$blueprint]) }}">Quote This Blueprint</a>
                </div>
            </div>
        </div>



        <div class="col-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Designing This Blueprint
                </div>

                {{-- FORD TRANSIT MOBILITY VANS --}}
                @if( $blueprint->base_van_id == 11 )
                    @includeIf('blueprint::blueprint.forms.mobility_ford_transit')
                @endif

                {{-- GRAND CARAVAN MOBILITY VANS --}}
                @if( $blueprint->base_van_id == 14 )
                    @includeIf('blueprint::blueprint.forms.mobility_grand_caravan')
                @endif

            </div>
        </div>
    </div>


    <hr>


    <div class="row">
        <div class="col-4">

            <div class="card border-secondary">
                <div class="card-header bg-secondary text-white">
                    Configuration
                </div>
                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.syspro_dat', [$blueprint]) }}">Syspro DAT File</a>

                    <a class="list-group-item list-group-item-action"
                       href="{{ route('blueprint.configuration', [$blueprint]) }}">Configuration</a>

{{--                    <div class="list-group-item list-group-item-action list-group-item-danger">--}}
                        <form method="POST"
                                action="{{ route('blueprint.reset', [$blueprint]) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="submit"
                                   value="Reset This Blueprint"
                                   class="list-group-item list-group-item-action list-group-item-danger">
                        </form>
{{--                      </div>--}}
                </div>
            </div>
        </div>

    </div>



@endsection