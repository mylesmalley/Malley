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
                       href="{{ route('blueprint.drawings.generate', [$blueprint]) }}">Email Me Drawing Package</a>
                </div>
                <div class="card-footer text-center">
                    <small>
                        If you request a drawing package before completing all the forms, you may have missing images.
                    </small>
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
                <div class="card-footer text-center">
                    <small>
                        As you select options in the forms on the right, they will appear on the quote.
                    </small>
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

                {{-- RAM PROMASTER MOBILITY VANS --}}
                @if( $blueprint->base_van_id == 12 )
                    @includeIf('blueprint::blueprint.forms.mobility_pro_master')
                @endif

                {{-- RAM PROMASTER MOBILITY VANS --}}
                @if( $blueprint->base_van_id == 31 )
                    @includeIf('blueprint::blueprint.forms.bls_transit')
                @endif





                {{-- RAM PROMASTER AMBULANCE --}}
                @if( $blueprint->base_van_id == 16 )
                    @includeIf('blueprint::blueprint.forms.ambulance_promaster')
                @endif
                <div class="card-footer text-center">
                    <small>
                        As you configure this van, forms will be added to this list.
                    </small>
                </div>
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
                    <a class="list-group-item list-group-item-action list-group-item-secondary"
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