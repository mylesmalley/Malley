@extends('vehicles::layout')

@php
    $inspection = new App\Models\Inspection;
@endphp

@section('content')


    <h1 class="text-center">Inspections </h1>

    <h2 class="text-center text-secondary">for <a href="/vehicles/{{ $vehicle->id}} ">
            {{ $vehicle->identifier }}
        </a></h2>



    @includeIf('vehicles::errors')


    <div class="card border-primary document-content-wrapper">
        <div class="card-body">
    <h2>Add Inspection</h2>
    <form method="POST"
          action="/vehicles/{{ $vehicle->id }}/inspections">
         @includeIf('vehicles::inspections.form')
    </form>

        </div>
    </div>

    <br>


    <div class="card border-primary document-content-wrapper">
        <div class="card-header text-white bg-primary">
            Inspections
        </div>
        <table class="table table-sm table-striped table-hover">
            <thead>
            <tr>
                <th> Date </th>
                <th> Descriptions </th>
                <th> Category </th>
                <th> Location </th>
                <th> Type </th>
                <th> Source </th>
                <th> Severity </th>
                <th>  </th>
            </tr>
            </thead>
            <tbody>


            @forelse( $vehicle->inspections as $inspection)
                <tr>
                    <td> {{ $inspection->date_entered }}  </td>
                    <td> {{ $inspection->description  }} </td>
                    <td> {{ $inspection->life_step }} </td>
                    <td> {{ $inspection->location }} </td>
                    <td> {{ $inspection->type }} </td>
                    <td> {{ $inspection->source }} </td>
                    <td> {{ $inspection->severity }} </td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                            href="{{ url('/vehicles/'.$vehicle->id.'/inspections/'.$inspection->id ) }}">Edit </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No inspection issues!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


@endsection
