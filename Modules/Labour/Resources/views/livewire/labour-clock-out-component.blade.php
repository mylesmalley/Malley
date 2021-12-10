<div
    @if ( !$labour_id )
        style="display: none;"
    @endif
    class="card border-info sticky-top">
    @if ( $labour )
        <div class="card-header bg-info text-white">
            <h3>
                Clock {{ $labour->user->first_name }} Out

                <a wire:click="cancel"  wire:keydown.escape="cancel" class="btn btn-warning btn-sm float-end">Cancel</a>
            </h3>
        </div>

        <div class="card-body text-center">

            <p>{{ $labour->user->first_name }} {{ $labour->user->last_name }} is clocked on to {{ $labour->job ?? '' }}. Do you want to clock them out?</p>

            @if ( $labour_id )
                <button class="btn btn-info"
                    wire:click="clock_out"
                    >Clock out</button>
                @endif

        </div>
    @endif
</div>
