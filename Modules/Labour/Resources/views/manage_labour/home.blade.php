@extends('labour::layouts.master')

@section('content')

    <div class="container">

        manage labour

        <div class="row">
            <div class="col-12">
                @include('labour::manage_labour.filter_tabs' )

{{--                {{ dd($start_date, $end_date, $user_id, $department, $active_tab) }}--}}
            </div>
        </div>
    </div>


        @endsection
