<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-2">
                <select wire:model="action.action"
                        aria-label=""
                    class="form-control">
                    <option value="switch_on">Switch On</option>
                    <option value="switch_off">Switch Off</option>
                    <option value="increment">Add One</option>
                    <option value="decrement">Subtract One</option>
                </select>

            </div>
            <div class="col-2">
                <input
                        class="form-control"
                        aria-label=""
                        placeholder="option id"
                        type="text" wire:model="action.option_id">
            </div>
            <div class="col-3">
                new action for {{ $answer->text }}
            </div>
            <div class="col-3">
                <button class="btn btn-success" wire:click="save">Add Action</button>
            </div>
                <input type="hidden" wire:model="action.value">
                <input type="hidden" wire:model="action.wizard_answer_id">
        </div>
    </form>
</div>
