@extends('labour::layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 class="text-secondary text-center">Labour Tracking Management</h4>
                <h1 class="text-center">Make Changes</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @includeIf('labour::management.user_filter' )
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-6">
                @if ( count($user_ids) && count($dates))
                    @livewire('labour::user-day-container', [ $user_ids, $dates])
                @endif
            </div>
            <div class="col-6">
{{--                @livewire('labour::labour-edit-component' )--}}
{{--                @livewire('labour::labour-clock-out-component' )--}}
{{--                @livewire('labour::labour-add-component' )--}}


                @livewire('labour::manage-labour-component')

                @livewire('labour::job-search-component' )

            </div>
        </div>


    </div>


        @endsection
