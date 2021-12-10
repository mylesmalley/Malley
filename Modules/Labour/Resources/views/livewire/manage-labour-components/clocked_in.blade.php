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
        <button wire:click="clock_out"
                class="btn btn-primary btn-lg">Clock Out</button>
    </div>
</div>