@extends('blueprint::layouts.master')

@section('stylesheet')
    <style>
        #menu {
            display: none;
            position: absolute;
            z-index: 10000;
            box-shadow: 0 0 5px grey;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">{{ $layout->name ?? "NA" }} Layout</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>





    <div class="row">
        <div class="col-12">
            <div id="konvaStage"></div>
        </div>

    </div>

    <div class="row">

        <div class="col-6">
            @livewire("blueprint::custom-layout-progress", [$blueprint, $layout] )
        </div>


        <div class="col-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Instructions
                </div>
                <div class="card-body">
                    <p>Right click anywhere on the floor diagram to open up a box with options. Click on a button next to any option to add it to the layout.</p>
                    <p>Drag any item you have added to the floor layout around to wherever you'd like it positioned.</p>
                    <p>Double-click on any item on the floor layout to delete it.</p>
                    <p>Any changes you make are saved automatically. You can leave this form and come back later.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>

@endsection


@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

{{--     REgular transit mobility - legacy stuff--}}
{{--    @if( (int)$blueprint->base_van_id === 11)--}}
{{--        @include('blueprint::floor_layout.transit_mobility.setup_scripts')--}}
{{--    @endif--}}

{{--     BLS--}}
    @if( (int)$blueprint->base_van_id === 31)

        <!-- BLS SETUP -->
        @include('blueprint::custom_layouts.setup.transit_bls_setup', [ 'c' => $configuration ])
    @endif

    @includeIf('blueprint::custom_layouts.scripts.custom_layout_handler')

@endpush