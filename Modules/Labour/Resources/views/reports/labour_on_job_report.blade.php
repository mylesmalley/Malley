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

                    <table>

                        @foreach( $by_date_by_dept as $date => $departments )
                            <tr>
                                <td>{{ $date }}</td>
                                @foreach( $departments as $dept => $time )
                                    <td>{{ number_format( $by_date_by_dept[$date][$dept], 2) }}</td>
                                @endforeach
                            </tr>

                        @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
