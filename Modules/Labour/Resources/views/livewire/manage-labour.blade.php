<div>
    @if( !$labour )
        <div class="card border-light">
            <div class="card-header bg-light">
                Managing Labour
            </div>
            <div class="card-body text-center">
                <p>Click on a record to make changes.</p>
            </div>
        </div>
    @endif

    <!-- Active labour record -->
    @if ( $labour )

        <!-- The record is already posted and can't be changed -->
        @if ( $labour->posted === true )

            <div class="card border-light">
                <div class="card-header bg-light">
                    Managing Labour
                </div>
                <div class="card-body text-center">
                    <p>This record has already been posted to Syspro and can't be changed now.</p>
                </div>
            </div>

        <!-- The record has not yet been posted and can be changed. -->
        @else

            <!-- The user is currently clocked in -->
            @if ( $clocked_in )
                <div class="card border-info sticky-top">
                    <div class="card-header bg-info text-white">
                        <h3>
                            Clock {{ $user->first_name }} Out

                            <a wire:click="cancel"  wire:keydown.escape="cancel" class="btn btn-warning btn-sm float-end">Cancel</a>
                        </h3>
                    </div>

                    <div class="card-body text-center">
                        <p>{{ $labour->user->first_name }} {{ $labour->user->last_name }} is clocked on to {{ $labour->job ?? '' }}. Do you want to clock them out?</p>

                    </div>
                </div>
            <!-- The user is clocked out, so this record can be fully changed. -->
            @else


            @endif
            <!-- End of changing records -->

        @endif
        <!-- End of currently active record -->

    @endif
    <!-- end of labour record loaded -->
    <!-- end of labour record loaded -->
</div>