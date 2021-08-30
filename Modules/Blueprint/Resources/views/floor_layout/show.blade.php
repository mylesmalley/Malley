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
            <h3 class="text-secondary">Floor Layout</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>

    @includeIf('blueprint::floor_layout.transit_mobility.standard_floor_menu')




    <div class="row">
        <div class="col-9">
            <div id="konvaStage"></div>
        </div>
        <div class="col-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Instructions
                </div>
                <div class="card-body">
                    <p>Right click anywhere on the floor diagram to open up a box with options. Click on a button next to any option to add it to the layout.</p>
                    <p>Drag any item you have added to the floor layout around to wherever you'd like it positioned.</p>
                    <p>Double-click on any item on the floor layout to delete it.</p>
                    <p>Any changes you make are saved automatically. You can leave this form and come back later.</p>
                    <p>Click "Confirm Seat Layout" when you are done.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            @livewire("blueprint::floor-layout-progress", [$blueprint] )

        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>

    @includeIf('blueprint::floor_layout.transit_mobility.standard_floor_options')

    @includeIf('blueprint::floor_layout.shared.floor_layout_management_script')

    <script>
        Konva.Image.fromURL(  `{{ mix('img/blueprint/floors/transit130.png') }}` , function (bg) {
            bg.setAttrs({
                x: 0,
                y: 0,
            });
            floorLayer.add(bg);
            floorLayer.draw();
        });
    </script>

    @endpush