<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-2">
                <select wire:model="action.action"
                    class="form-control">
                    <option value="switch_on">Switch On</option>
                    <option value="switch_off">Switch Off</option>
                    <option value="increment">Add One</option>
                    <option value="decrement">Subtract One</option>
                </select>

            </div>
            <div class="col-2">
                <input type="text" wire:model="action.option_id">
            </div>
                <input type="hidden" wire:model="action.value">

                <input type="hidden" wire:model="action.wizard_answer_id">
        </div>
        new action for {{ $answer->text }}
        <button wire:click="save">save</button>
    </form>
</div>
