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
            <div class="col-6 sticky-top">


                @if ( $mode === 'add'  )
                    @include('labour::manage_labour.add_labour')
                    @livewire('labour::job-search-component', ['user_id'=> request()->input('selected_user',Auth::user()->id )] )

                @endif

                    @if ( $mode === 'clock_out'  )
                        @include('labour::manage_labour.clock_out')
                    @endif

                    @if ( $mode === 'edit' && $labour != null )
                        @include('labour::manage_labour.edit_labour')
                        @livewire('labour::job-search-component', ['user_id'=> request()->input('selected_user',Auth::user()->id )] )

                    @endif


            </div>
        </div>
    </div>

x
        @endsection
