@php
    $a_user_day_is_active = request()->has(['selected_user', 'selected_date']);
    $this_user_day_is_active =
        request()->has(['selected_user', 'selected_date'])
        && request()->input('selected_user') == $ud['user']['id']
        && request()->input('selected_date') ==   $ud['date'];
@endphp

<div class="card border-secondary">
    <div class="card-header bg-secondary text-white">
        {{ $ud['user']['first_name'] }} {{ $ud['user']['last_name'] }} on {{ $ud['monthDay'] }}

        @if ( $a_user_day_is_active )
            @if ($this_user_day_is_active)
                selected!!!!
            @endif
        @else
            no day selected
        @endif
        <a href="{{ request()->fullUrlWithQuery([
                'selected_user'=>$ud['user']['id'],
                'selected_date'=>$ud['date'],
            ]) }}">select</a>


    </div>

    <table  class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Job</th>
                <th>Department</th>
                <th>Started At</th>
                <th>Finished At</th>
                <th>Elapsed</th>
            </tr>
        </thead>
        <tbody>
            @forelse( $ud['labour'] as $lab )

                <tr
                    class="
{{--                    {{  $lab['id'] === $selectedRow ? 'table-info' : '' }}--}}
                    {{  $lab['flagged'] ? 'table-warning' : '' }} ">

                    <td>{{ $lab['job'] }}</td>
                    <td>{{ $lab['department'] ?? "Department" }}</td>
                    <td>{{ $lab['start'] }}</td>

                    <td>
                        @if ( ! $lab['end'] )
                            Ongoing
                        @else
                            {{ $lab['end'] }}
                        @endif
                    </td>

                    <td>{{ $lab['elapsed'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center"> No labour on this date</td>
                </tr>
            @endforelse
        </tbody>
            <tfoot>
            <tr>
                <td colspan="4"></td>
                <td >{{ $ud['total_elapsed_labour'] }} Hours</td>
            </tr>
        </tfoot>
    </table>

</div>
<br>

{{--<div class="--}}
{{--            card border-info">--}}
{{--    <div class="card-header bg-info text-white">--}}
{{--        @else--}}
{{--            <div class="--}}
{{--            card border-secondary">--}}
{{--                <div class="card-header bg-secondary text-white">--}}
{{--                    @endif--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-4 text-left">--}}
{{--                            {{ $ud['user']['first_name'] }} {{ $ud['user']['last_name'] }}--}}
{{--                        </div>--}}
{{--                        <div class="col-4 text-center" >--}}
{{--                            {{ $ud['dayName'] }}--}}
{{--                            {{ $ud['monthDay'] }}--}}

{{--                        </div>--}}
{{--                        <div class="col-4 text-end">--}}

{{--                            @if (! $locked )--}}
{{--                                <button--}}
{{--                                        wire:click="addTime('{{  $ud['date'] }}', {{ $ud['user']['id'] }})"--}}
{{--                                        class="btn btn-success btn-sm">Add--}}
{{--                                </button>--}}
{{--                            @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <table  class="table table-striped table-hover table-sm">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Job</th>--}}
{{--                        <th>Department</th>--}}
{{--                        <th>Started At</th>--}}
{{--                        <th>Finished At</th>--}}
{{--                        <th>Elapsed</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse( $ud['labour'] as $lab )--}}

{{--                        <tr wire:click="manageTime({{ $lab['id'] }})"--}}
{{--                            class="--}}
{{--                            {{  $lab['id'] === $selectedRow ? 'table-info' : '' }}--}}
{{--                            {{  $lab['flagged'] ? 'table-warning' : '' }} ">--}}

{{--                            <td>{{ $lab['job'] }}</td>--}}
{{--                            <td>{{ $lab['department'] ?? "Department" }}</td>--}}
{{--                            <td>{{ $lab['start'] }}</td>--}}

{{--                            <td>--}}
{{--                                @if ( ! $lab['end'] )--}}
{{--                                    Ongoing--}}
{{--                                @else--}}
{{--                                    {{ $lab['end'] }}--}}
{{--                                @endif--}}
{{--                            </td>--}}

{{--                            <td>{{ $lab['elapsed'] }}</td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="6" class="text-center"> No labour on this date</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}


{{--                    </tbody>--}}
{{--                    <tfoot>--}}
{{--                    <tr>--}}
{{--                        <td colspan="4"></td>--}}
{{--                        <td >{{ $ud['total_elapsed_labour'] }} Hours</td>--}}
{{--                    </tr>--}}
{{--                    </tfoot>--}}
{{--                </table>--}}

{{--            </div>--}}