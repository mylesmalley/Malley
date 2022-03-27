@extends('labour::layouts.master')

@section('content')

    <div class="container">

        manage labour

        <div class="row">
            <div class="col-12">
                @include('labour::manage_labour.filter_tabs' )


{{--                {{ dd( $user_days ) }}--}}
{{--                {{ dd($start_date, $end_date, $user_id, $department, $active_tab) }}--}}
            </div>
        </div>


        <div class="row">
            <div class="col-6">
                @forelse( $user_days as $ud )
                    @includeIf('labour::manage_labour.user_day', [ 'ud' => $ud ])
                @empty
                    <h2>No records</h2>
                @endforelse
            </div>
            <div class="col-6">
                @if ( $mode === 'add' )
                    ADD NEW
                    <a class="btn btn-sm btn-danger"
                       href="{{ request()->fullUrlWithQuery([
                        'selected_user'=>null,
                        'selected_date'=>null,
                        'mode' =>  null,
                    ]) }}">Cancel</a>
                @endif
            </div>
        </div>
    </div>


        @endsection
