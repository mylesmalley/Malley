@extends('labour::layouts.master')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 class="text-secondary text-center">Labour on Job</h4>
                <h1 class="text-center">{{ $job ?? "Pick a Job" }}</h1>
            </div>
        </div>


        <div class="row">
            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Departments
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            @foreach( $unique_departments as $ud )
                                <tr>
                                    <td>{{ $ud['name'] }}</td>
                                    <td>{{ number_format( $ud['elapsed_labour'] / 3600, 1) }} Hrs</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>{{ number_format( $total_labour / 3600, 1) }} Hrs</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Employees
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            @foreach( $unique_users as $uu )
                                <tr>
                                    <td>{{ $uu['first_name'] . ' ' . $uu['last_name'] }}</td>
                                    <td>{{ number_format( $uu['elapsed_labour'] / 3600, 1) }} Hrs</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>{{ number_format( $total_labour / 3600, 1) }} Hrs</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="col-4">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Dates
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        @foreach( $used_dates as $date => $time )
                            <tr>
                                <td>{{ $date }}</td>
                                <td>{{ number_format( $time / 3600, 1) }} Hrs</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>{{ number_format( $total_labour / 3600, 1) }} Hrs</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-header text-white bg-primary">
                        All Records
                    </div>
                    <table class="table table-sm table-hover table-striped">
                        <thead>

                        </thead>
                        <tbody>
                            @foreach( $labour as $l )
                                <tr>
                                    <td>{{ $l->start->format('Y-m-d') }}</td>
                                    <td>{{ $l->user->first_name . ' ' . $l->user->last_name }}</td>
                                    <td>{{ $l->department->name }}</td>
                                    <td>{{ $l->start->format('g:i A') }}</td>
                                    <td>{{ $l->end->format('g:i A') ?? 'Ongoing' }}</td>
                                    <td>{{ number_format( (int)$l->elapsed->totalSeconds / 3600, 1) }} Hrs</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card border-primary">--}}
{{--                    <div class="card-header bg-primary text-center text-white">--}}
{{--                        By Date, By Department--}}
{{--                    </div>--}}

{{--                    <table class="table table-striped table-hover table-sm">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Date</th>--}}
{{--                            @foreach( $unique_departments as $ud => $v )--}}
{{--                                <th>{{ $departments[ $ud ] }}</th>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}

{{--                        @foreach( $by_date_by_dept as $date => $departments )--}}
{{--                            @if( $departments[count($unique_departments)] != 0)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $date }}</td>--}}
{{--                                    @foreach( $departments as $dept => $time )--}}
{{--                                        <td>{{ number_format( $departments[$dept] /3600, 2) }}</td>--}}
{{--                                    @endforeach--}}
{{--                                    <td>{{ number_format( $departments[count($unique_departments)] /3600, 2) }}</td>--}}
{{--                                </tr>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}


{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection
