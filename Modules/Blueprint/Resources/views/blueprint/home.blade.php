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
                       href="{{ route('my_blueprints') }}">My Blueprints</a>
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
                       href="{{ route('my_blueprints') }}">My Blueprints</a>
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

            </div>
        </div>
    </div>


    <hr>




@endsection