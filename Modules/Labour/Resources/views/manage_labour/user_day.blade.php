@php
    $a_user_day_is_active = request()->has(['selected_user', 'selected_date']);
    $this_user_day_is_active =
        request()->has(['selected_user', 'selected_date'])
        && request()->input('selected_user') == $ud['user']['id']
        && request()->input('selected_date') ==   $ud['date'];
@endphp

<div class="card border-secondary m-1">
    <div class="card-header bg-secondary text-white">
        {{ $ud['user']['first_name'] }} {{ $ud['user']['last_name'] }} on {{ $ud['monthDay'] }}

        <a class="float-end"
           href="{{ route('labour.management.clear_cache', [$ud['user']['id'],$ud['date']]) }}">
            <img style="width:
            15px; height:15px;
            filter: invert(100%);"
                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABE0lEQVRIibWVv0rFMBSHP+ron76Am+1uXbWLdtXH8S4Xr69h36GvIMXl7nfp4iS4VATBjkIdckpD8KYmbX5QAqe/nC/k5CTgpkdHv3PyPnTyIAA9eQ90QAOUQBECYH41kC4JOQQyYA20EvsE8qUguk6ASoMkS0BMRRrkeSrBFXDvAY4Zt+vGZizFdOcBeZC5TzbTTkznHoBM5jY20xfjSXHVscz91oORYTrYE3fRjw3wLuOZR+Kh2d5sgBcZbz0ApzJubaYCtY8tqolctQIup0y1QCr+rsXsNyFFtf0AiY3//RKQXIN8oJroAjhivPRmQxLU3WK7qichtvP+ClyjCl+iOrSbteR/alj9JiQgWHJwLO4vxc1ViHdP3xMAAAAASUVORK5CYII=" alt="">
            
        </a>
    </div>

    <table  class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Job</th>
                <th>Department</th>
                <th>Started At</th>
                <th>Finished At</th>
                <th>Elapsed</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if( $a_user_day_is_active && $this_user_day_is_active && $mode === 'add' )
                <tr class="table-success">
                    <td class="text-end" colspan="100">
                        Adding time to this day -->
                    </td>
                </tr>
                @endif

            @forelse( $ud['labour'] as $lab )

                <tr
                    class="
                    {{  $lab['flagged'] ? 'table-warning' : '' }}
                    {{ request()->has('labour_id')
                        && request()->input('labour_id') == $lab['id'] ? "table-info" : "" }}

                            ">

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
                    <td>
                        @if ( !$form_locked )
                            @if (  $lab['end'] )
                                <a class="btn btn-sm btn-outline-secondary"
                                    href="{{ request()->fullUrlWithQuery([
                                    'selected_user'=>$ud['user']['id'],
                                    'selected_date'=>$ud['date'],
                                    'mode' => 'edit',
                                     'form_locked' => true,
                                    'labour_id' => $lab['id'],
                                ]) }}">Edit</a>
                            @else
                                <a class="btn btn-sm btn-outline-dark"
                                   href="{{ request()->fullUrlWithQuery([
                                        'selected_user'=>$ud['user']['id'],
                                        'selected_date'=>$ud['date'],
                                        'mode' => 'clock_out',
                                        'form_locked' => true,
                                        'labour_id' => null,
                                    ]) }}">Clock Out</a>
                            @endif
                        @endif

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6"
                        class="text-center"> No labour on this date</td>
                </tr>
            @endforelse
        </tbody>
            <tfoot>
            <tr>
                <td colspan="4">


                    @if ( $a_user_day_is_active )

                    @else
                        <a class="btn btn-sm btn-success"
                           href="{{ request()->fullUrlWithQuery([
                        'selected_user'=>$ud['user']['id'],
                        'selected_date'=>$ud['date'],
                        'mode' => 'add',
                        'form_locked' => true,
                        'labour_id' => null,
                    ]) }}">Add Time</a>

{{--                        no day selected--}}
                    @endif
                    
                    
                </td>
                <td >{{ $ud['total_elapsed_labour'] }} Hours</td>
            </tr>
        </tfoot>
    </table>

</div>

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