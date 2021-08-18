@extends('bugreport::template')

@section('content')

    <ul class="list-group list-group-horizontal">
        @foreach( $users as $l )
            <li class="list-group-item">
                <a href="{{ url("/bugs/user/{$l->id}") }}">
                 {{ $l->first_name . ' ' . $l->last_name }}

                </a>
                <span class="badge badge-primary badge-pill">{{ $l->bug_report_tasks_count }}</span>
                </li>

        @endforeach
    </ul>

    <h1>{{ $user->first_name }}'s Assigned Tasks</h1>
        <h2>Open Projects</h2>

        @foreach( $openBugs as $bug )
            @include('bugreport::partials.bugView', ['bug' => $bug ])
        @endforeach

    <h2>On Hold Projects</h2>

    @foreach( $onHoldBugs as $bug )
        @include('bugreport::partials.bugView', ['bug' => $bug ])
    @endforeach




    {{--        <table class='table table-striped table-condensed table-hover'>--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>#</th>--}}
{{--                <th>Submitted By</th>--}}
{{--                <th>Title</th>--}}
{{--                <th>Description</th>--}}
{{--                <th>Urgency</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @forelse($open as $bug)--}}
{{--                <tr--}}
{{--                    onclick="window.location = '/bugs/{{ $bug->id }}'">--}}
{{--                    <td>{{ $bug->id }}</td>--}}
{{--                    <td>{{ $bug->userName }}</td>--}}
{{--                    <td>{{ $bug->title }}</td>--}}
{{--                    <td>{{ substr($bug->user_notes, 0, 100 ) }}--}}
{{--                        @if( strlen( $bug->user_notes) > 99 )--}}
{{--                            ...--}}
{{--                        @endif--}}
{{--                        @if( $bug->dev_notes)--}}
{{--                            <hr >--}}
{{--                            {{ $bug->dev_notes }}--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td  >{{ $bug->urgencyLabel  }}</td>--}}
{{--                </tr>--}}

{{--            @empty--}}
{{--                <tr>--}}
{{--                    <td colspan="6">No Issues</td>--}}
{{--                </tr>--}}
{{--            @endforelse--}}
{{--            </tbody>--}}

{{--        </table>--}}


{{--        <h2>On Hold Issues</h2>--}}
{{--        <table class='table table-striped table-condensed table-hover'>--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>#</th>--}}
{{--                <th>Submitted By</th>--}}
{{--                <th>Title</th>--}}
{{--                <th>Description</th>--}}
{{--                <th>Urgency</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @forelse($onHold as $bug)--}}
{{--                <tr--}}
{{--                    onclick="window.location = '/bugs/{{ $bug->id }}'">--}}
{{--                    <td>{{ $bug->id }}</td>--}}
{{--                    <td>{{ $bug->userName }}</td>--}}
{{--                    <td>{{ $bug->title }}</td>--}}
{{--                    <td>{{ substr($bug->user_notes, 0, 100 ) }}--}}
{{--                        @if( strlen( $bug->user_notes) > 99 )--}}
{{--                            ...--}}
{{--                        @endif--}}
{{--                        @if( $bug->dev_notes)--}}
{{--                            <hr >--}}
{{--                            {{ $bug->dev_notes }}--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                    <td--}}
{{--                    <td  >{{ $bug->urgencyLabel  }}</td>--}}
{{--                </tr>--}}
{{--            @empty--}}
{{--                <tr>--}}
{{--                    <td colspan="6">No Issues</td>--}}
{{--                </tr>--}}
{{--            @endforelse--}}
{{--            </tbody>--}}

{{--        </table>--}}


@endsection
