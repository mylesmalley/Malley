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
            @includeIf('bodyguardbom::kits.home_page_sections.syspro_components', ['show_edit_button' => false])
        </div>

        <div class="col-6">
            @includeIf('bodyguardbom::kits.home_page_sections.local_components' )
        </div>
    </div>



    @includeIf('app.components.errors')
    <ul>


        <li class="row">

        </li>

    </ul>

@endsection