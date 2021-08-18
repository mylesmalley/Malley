@extends('bugreport::template')

@section('content')

    <h1>Unnasigned Engineering Tasks</h1>
    <table class='table table-striped table-condensed table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th>Submitted By</th>
            <th>Title</th>
            <th>Description</th>
            <th>Urgency</th>
            <th>Assigned To</th>
        </tr>
        </thead>
        <tbody>
        @foreach($engineering as $bug)
            <tr

                onclick="window.location = '/bugs/{{ $bug->id }}'">
                <td>{{ $bug->id }}</td>
                <td>{{ $bug->userName }}</td>
                <td>{{ $bug->title }}</td>
                <td>{{ substr($bug->user_notes, 0, 100 ) }}
                    @if( strlen( $bug->user_notes) > 99 )
                        ...
                    @endif
                    @if( $bug->dev_notes)
                        <hr >
                        {{ $bug->dev_notes }}
                    @endif
                </td>
                <td>{{ $bug->urgencyLabel  }}</td>
                <td>{{ $bug->assignedUser->first_name ?? 'Not Assigned' }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>




    <h1>Unnasigned Blueprint Tasks</h1>
    <table class='table table-striped table-condensed table-hover'>
        <thead>
        <tr>
            <th>#</th>
            <th>Submitted By</th>
            <th>Title</th>
            <th>Description</th>
            <th>Urgency</th>
            <th>Assigned To</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blueprint as $bug)
            <tr

                onclick="window.location = '/bugs/{{ $bug->id }}'">
                <td>{{ $bug->id }}</td>
                <td>{{ $bug->userName }}</td>
                <td>{{ $bug->title }}</td>
                <td>{{ substr($bug->user_notes, 0, 100 ) }}
                    @if( strlen( $bug->user_notes) > 99 )
                        ...
                    @endif
                    @if( $bug->dev_notes)
                        <hr >
                        {{ $bug->dev_notes }}
                    @endif
                </td>
                <td>{{ $bug->urgencyLabel  }}</td>
                <td>{{ $bug->assignedUser->first_name ?? 'Not Assigned' }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>


@endsection



