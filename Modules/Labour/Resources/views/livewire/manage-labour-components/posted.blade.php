<div class="card border-light">
    <div class="card-header bg-light">
        Managing Labour
        <a wire:click="cancelManageTime"
           wire:keydown.escape="cancelManageTime"
           class="btn btn-warning btn-sm float-end">
            Cancel
        </a>
    </div>
    <div class="card-body text-center">
        <p>This record has already been posted to Syspro and can't be changed now.</p>
    </div>
</div>