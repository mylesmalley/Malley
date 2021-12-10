<div>
    @if( !$labour )
        @includeIf('labour::livewire.manage-labour-components.info')
    @endif

    <!-- Active labour record -->
    @if ( $labour )

        <!-- The record is already posted and can't be changed -->
        @if ( $labour->posted === true )
            @includeIf('labour::livewire.manage-labour-components.posted')

        <!-- The record has not yet been posted and can be changed. -->
        @else

            <!-- The user is currently clocked in -->
            @if ( $clocked_in )

                <div class="card border-info sticky-top">
                    <div class="card-header bg-info text-white">
                        <h3>
                            Clock {{ $user->first_name }} Out
                            <a wire:click="cancelManageTime"
                               wire:keydown.escape="cancelManageTime"
                               class="btn btn-warning btn-sm float-end">
                                Cancel
                            </a>
                        </h3>
                    </div>

                    <div class="card-body text-center">
                        <p>{{ $labour->user->first_name }} {{ $labour->user->last_name }}
                            is clocked on to {{ $labour->job ?? '' }}.
                            Do you want to clock them out?</p>

                    </div>
                </div>
            <!-- The user is clocked out, so this record can be fully changed. -->
            @else
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                            Editing Time for {{ $user->first_name }} on {{ $labour->start->format('M d') }}
                            <a wire:click="cancelManageTime"
                               wire:keydown.escape="cancelManageTime"
                               class="btn btn-warning btn-sm float-end">
                                Cancel
                            </a>
                    </div>
                    <div class="card-body">

                    </div>
                </div>

            @endif
            <!-- End of changing records -->

        @endif
        <!-- End of currently active record -->

    @endif
    <!-- end of labour record loaded -->
    <!-- end of labour record loaded -->
</div>