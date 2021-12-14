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
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-center text-white">
                        By Date, By Department
                    </div>

                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                @foreach( $unique_departments as $ud => $v )
                                    <th>{{ $departments[ $ud ] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $by_date_by_dept as $date => $departments )
                                @if( $by_date_by_dept[$date][count($unique_departments)] != 0)
                                    <tr>
                                        <td>{{ $date }}</td>
                                        @foreach( $departments as $dept => $time )
                                            <td>{{ number_format( $by_date_by_dept[$date][$dept] /3600, 2) }}</td>
                                        @endforeach
                                        <td>{{ number_format( $by_date_by_dept[$date][count($unique_departments)] /3600, 2) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
