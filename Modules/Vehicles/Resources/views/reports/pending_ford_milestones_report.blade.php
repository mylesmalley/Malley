@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Pending Ford Events</h1>

    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach( $pending as $event )
                    <tr>
                        <td>{{ $event->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection