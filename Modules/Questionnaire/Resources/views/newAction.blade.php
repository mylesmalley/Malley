<div>

        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-2">
                    <input type="text" wire:model="action.action">
                </div>
                <div class="col-2">
                    <input type="text" wire:model="action.option_id">
                </div>
                <div class="col-2">
                    <input type="text" wire:model="action.value">
                </div>
                <div class="col-2">
                    <input type="text" wire:model="action.wizard_answer_id">
                </div>
            </div>
            new action for {{ $answer->text }}
            <button wire:click="save">save</button>
        </form>
</div>
