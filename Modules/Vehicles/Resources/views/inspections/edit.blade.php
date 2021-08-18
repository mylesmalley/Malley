@extends('vehicles::layout')

@section('content')

            <h1 class="text-center">Edit Inspection #{{ $inspection->id }} </h1>
                <h2 class="text-center text-secondary">For <a href="/vehicles/{{ $vehicle->id}} ">
                    {{ $vehicle->identifier }}
                    </a></h2>



    @includeIf('vehicles::errors')


    <div class="card border-primary document-content-wrapper">
        <div class="card-body">


    <h2>Edit Inspection</h2>
    <form method="POST"
          action="/vehicles/{{ $vehicle->id }}/inspections/{{ $inspection->id }}">
        {{ method_field('PATCH') }}

        @includeIf('vehicles::inspections.form')
    </form>

    <br />
    <br />

    <form method="POST"
          action="/vehicles/{{ $vehicle->id}}/inspections/{{ $inspection->id }}">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}

        <div class="form-group">
            <input type="submit" class="btn btn-danger" value="Delete This Inspection">
        </div>
    </form>

        </div>
    </div>
@endsection
