@extends('bodyguardbom::layouts.master')

@section('content')


    <div class="row">
        <div class="col-12 text-center">
            <h1>{{ $kit->part_number }}</h1>
            <h3 class="text-secondary">Bill of Materials</h3>

        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-6">
            @includeIf('bodyguardbom::kits.component_partials.syspro_components', ['show_edit_button' => false])
        </div>

        <div class="col-6">
            @includeIf('bodyguardbom::kits.component_partials.local_components' )
            <br>
            @includeIf('bodyguardbom::kits.component_partials.add_local_component' )
        </div>
    </div>



    @includeIf('app.components.errors')
    <ul>


        <li class="row">

        </li>

    </ul>

@endsection