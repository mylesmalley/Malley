@extends('labour::layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="text-secondary text-center">Labour Tracking Management</h4>
                <h1 class="text-center">All Jobs in Syspro</h1>
            </div>
        </div>
        <div class="row g-2">

            <div class="col-12">
                    @livewire('labour::all-syspro-jobs')
            </div>

        </div>
        <br>
    </div>

@endsection
