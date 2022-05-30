@extends('labour::layouts.master')

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-12">
                <h4 class="text-secondary text-center">Labour Tracking Management</h4>
                <h1 class="text-center">Clocked In Staff</h1>
            </div>
        </div>
        <br>

        <div class="card border-primary">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Working On</th>
                        <th>Time Started</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse( $labour as $l )
                        <tr>
                            <td>{{ $l->user->id }}</td>
                            <td>{{ $l->user->first_name }}</td>
                            <td>{{ $l->user->last_name }}</td>
                            <td>{{ $l->user->department->name }}</td>
                            <td><a href="{{ route('labour.reports.labour_on_job', [$l->job]) }}">{{ $l->job }}</a></td>
                            <td>{{ $l->start->format('g:i a') }}</td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
