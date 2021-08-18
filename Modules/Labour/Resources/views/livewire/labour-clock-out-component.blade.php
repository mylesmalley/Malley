<div
    @if ( !$labour_id )
        style="display: none;"
    @endif
    class="card border-info sticky-top">
    <div class="card-header bg-info text-white">
        <h3>
            Clock This Person Out

            <a wire:click="cancel"  wire:keydown.escape="cancel" class="btn btn-warning btn-sm float-end">Cancel</a>
        </h3>
    </div>

    <div class="card-body text-center">

        <p>Stop this person from clocking labour onto a job. </p>

        @if ( $labour_id )
            <button class="btn btn-info"
                wire:click="clock_out"
                >Clock out</button>
            @endif

    </div>

</div>
