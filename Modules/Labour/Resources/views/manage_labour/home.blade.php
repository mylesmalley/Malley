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

{{--                        @if ( $selectedDate === $ud['date'] && $ud['user']['id'] === $selectedUser )--}}

{{--                            <div class="--}}
{{--            card border-info">--}}
{{--                                <div class="card-header bg-info text-white">--}}
{{--                                    @else--}}
{{--                                        <div class="--}}
{{--            card border-secondary">--}}
{{--                                            <div class="card-header bg-secondary text-white">--}}
{{--                                                @endif--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-4 text-left">--}}
{{--                                                        {{ $ud['user']['first_name'] }} {{ $ud['user']['last_name'] }}--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-4 text-center" >--}}
{{--                                                        {{ $ud['dayName'] }}--}}
{{--                                                        {{ $ud['monthDay'] }}--}}

{{--                                                    </div>--}}
{{--                                                    <div class="col-4 text-end">--}}

{{--                                                        @if (! $locked )--}}
{{--                                                            <button--}}
{{--                                                                    wire:click="addTime('{{  $ud['date'] }}', {{ $ud['user']['id'] }})"--}}
{{--                                                                    class="btn btn-success btn-sm">Add--}}
{{--                                                            </button>--}}
{{--                                                        @endif--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <table  class="table table-striped table-hover table-sm">--}}
{{--                                                <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Job</th>--}}
{{--                                                    <th>Department</th>--}}
{{--                                                    <th>Started At</th>--}}
{{--                                                    <th>Finished At</th>--}}
{{--                                                    <th>Elapsed</th>--}}
{{--                                                </tr>--}}
{{--                                                </thead>--}}
{{--                                                <tbody>--}}
{{--                                                @forelse( $ud['labour'] as $lab )--}}

{{--                                                    <tr wire:click="manageTime({{ $lab['id'] }})"--}}
{{--                                                        class="--}}
{{--                            {{  $lab['id'] === $selectedRow ? 'table-info' : '' }}--}}
{{--                                                        {{  $lab['flagged'] ? 'table-warning' : '' }} ">--}}

{{--                                                        <td>{{ $lab['job'] }}</td>--}}
{{--                                                        <td>{{ $lab['department'] ?? "Department" }}</td>--}}
{{--                                                        <td>{{ $lab['start'] }}</td>--}}

{{--                                                        <td>--}}
{{--                                                            @if ( ! $lab['end'] )--}}
{{--                                                                Ongoing--}}
{{--                                                            @else--}}
{{--                                                                {{ $lab['end'] }}--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}

{{--                                                        <td>{{ $lab['elapsed'] }}</td>--}}
{{--                                                    </tr>--}}
{{--                                                @empty--}}
{{--                                                    <tr>--}}
{{--                                                        <td colspan="6" class="text-center"> No labour on this date</td>--}}
{{--                                                    </tr>--}}
{{--                                                @endforelse--}}


{{--                                                </tbody>--}}
{{--                                                <tfoot>--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="4"></td>--}}
{{--                                                    <td >{{ $ud['total_elapsed_labour'] }} Hours</td>--}}
{{--                                                </tr>--}}
{{--                                                </tfoot>--}}
{{--                                            </table>--}}

{{--                                        </div>--}}
{{--                                        <br>--}}

                                        @empty
                                            <h2>No records</h2>

                                        @endforelse


            </div>
        </div>
    </div>


        @endsection
