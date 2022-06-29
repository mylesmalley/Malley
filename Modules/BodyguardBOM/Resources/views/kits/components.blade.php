@extends('bodyguardbom::layouts.master')

@section('content')


    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8 text-center">
            <h1>{{ $kit->part_number }}</h1>
            <h3 class="text-secondary ">Bill of Materials

            </h3>

        </div>
        <div class="col-2">
            <a class='btn btn-secondary float-end'
               href="{{ route('bg.kits.show', $kit) }}">Back to Kit</a>
        </div>
    </div>
    @includeIf('app.components.errors')

    <br>



    <div class="row">
        <div class="col-6">
            @includeIf('bodyguardbom::kits.component_partials.syspro_components', ['show_edit_button' => false])
        </div>

        <div class="col-6">
            @includeIf('bodyguardbom::kits.component_partials.local_components' )
            <br>
            @includeIf('bodyguardbom::kits.component_partials.add_local_component' )
            <br>

            <div class="card bg-warning border-warning">
                <div class="card-body">
                    <form action="{{ route('bg.kits.components.push_to_syspro', $kit->id ) }}"
                          method="POST">
                        @csrf
                        <input type="submit" class="btn btn-warning" value="Update Syspro with Your Changes">
                    </form>
                    <small>Will overwrite whatever is currently in Syspro!</small>
                </div>
            </div>

            <br>

            @includeIf('bodyguardbom::kits.component_partials.import_components' )

            <br>

            @if( str_starts_with( $kit->part_number, 'BGK' ))

            <div class="card bg-dark border-dark text-white">
                <div class="card-body">
                    <a class="btn btn-light" href="{{ route('bg.kits.components_from_template', $kit ) }}">Add Components from Template</a>
                </div>
            </div>

                @endif

        </div>
    </div>

    <hr>


    <div class="row">
        <div class="col-6">



        </div>
        <div class="col-6">

            <div class="card bg-danger border-danger">
                <div class="card-body">
                    <form method="POST"
                          action="{{ route('bg.kits.components.clear_local_stock_codes', $kit->id ) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Clear All Local Components">
                    </form>
                </div>
            </div>


        </div>
    </div>







@endsection