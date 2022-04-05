@extends('labour::layouts.master')

@section('content')
    <div class="container">
        <br>
        <div class="row g-2">
            <div class="col-12">
                @includeIf('labour::userInfo')
            </div>
            <div class="col-12">
                @if ( $user->hasActiveLabour )
                     <!-- clocked-in -->
                    @livewire('labour::clocked-in', ['user' => $user ])

                     <!-- history -->
                         <div class="card border-primary">
                        <div class="card-header">
                            <h3>My history</h3>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Job</th>
                                    <th>Date</th>
                                    <th>Started</th>
                                    <th>Stopped</th>
{{--                                    <th>Flag Issue?</th>--}}
                                    <th>Elapsed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $user->labourHistory() as $history )
                                    <tr>
                                        <td>{{ $history->job }}</td>
                                        <td>{{ $history->start->format('Y-m-d') }}</td>
                                        <td>{{ $history->start->format('g:i A') }}</td>
                                        <td>
                                            @if ( $history->end )
                                            {{ $history->end->format('g:i A') }}
                                            @else
                                                Ongoing
                                            @endif

                                        </td>
{{--                                        <td>--}}

{{--                                            @if ( $history->end && !$history->posted )--}}
{{--                                                <form action="{{ route('labour.flag') }}" method="POST">--}}
{{--                                                    @method('PATCH')--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="id" value="{{ $history->id }}">--}}
{{--                                                        @if (  $history->flagged )--}}
{{--                                                            <input type="image" src="{{ mix('img/on-flag.png') }}" alt="flag" width="20">--}}
{{--                                                        @else--}}
{{--                                                            <input type="image" src="{{ mix('img/off-flag.png') }}" alt="flag" width="20">--}}
{{--                                                        @endif--}}

{{--                                                </form>--}}
{{--                                            @endif--}}

{{--                                        </td>--}}
                                        <td>{{ $history->elapsed->forHumans(['parts'=>2]) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5"> No history yet </td>
                                    </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>

                @else
                    <!-- clocked-out -->
                 <!--   {{ $user->id }} -->
                        <!-- syspro-jobs -->

                        @livewire('labour::syspro-jobs')
                @endif
            </div>

        </div>
        <br>
    </div>

@endsection
