<div
{{--    wire:key="{{ $user->id }}-{{ $date }}"--}}
>

    <div class="card border-secondary">
        <div class="card-header bg-secondary text-white">
            <div class="row">
                <div class="col-4 text-left">
                    {{ $user->first_name }} {{ $user->last_name }}
                </div>
                <div class="col-4 text-center">
                    {{ $date->format('l') }}
                </div>
                <div class="col-4 text-end">
                    {{ $date->format('M d') }}
                </div>
            </div>

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
                @forelse( $labour as $lab )

                    <tr
                        @if ( !$locked )
                            @if ( ! $lab->end )
                                wire:click="clockOutRow({{ $lab->id }})"
                            @else
                                wire:click="editRow({{ $lab->id }})"
                            @endif
{{--                        @else--}}
{{--                            wire:click="$emit('null')"--}}
                        @endif

                        @if ( $lab->id === $selectedRow )
                            class="table-info"
                         @endif
                    >

                        <td>{{ $lab->job }}</td>
                        <td>{{ $lab->department->name ?? "Department" }}</td>
                        <td>{{ $lab->start->format('g:i A') }}</td>

                        <td>
                            @if ( ! $lab->end )
                                Ongoing
                            @else
                                {{ $lab->end->format( "g:i A") }}
                                @endif
                            </td>

                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center"> No labour on this date</td>
                    </tr>
                @endforelse
{{--                @if ( $adding_row_indicator )--}}
{{--                    <tr>--}}
{{--                        <td colspan="6" class="table-success text-center"> You are adding time to this date</td>--}}
{{--                    </tr>--}}
{{--                @endif--}}

            </tbody>
        </table>            @if (! $locked )

        <div class="card-footer text-end">
{{--            <a wire:click="refreshLabour">Refresh</a>--}}
                <button
                    wire:click="addRow('{{ $date->format('Y-m-d') }}', {{ $user->id }})"
                    class="btn btn-success btn-sm">Add Labour
                </button>
        </div>
        @endif

    </div>
    <br>
</div>
