<div>
    <form wire:submit.prevent="save">
        <h3>New Answer for Question {{ $question->text }}</h3>
        <div class="row">

            <div class="col-6">
                <input class="form-control"
                       placeholder="text of the answer"
                       aria-label=""

                       type="text" wire:model="answer.text">
            </div>
            <div class="col-2">
                <input
                        placeholder="ID of next question"
                        class="form-control"
                        aria-label=""

                        type="text" wire:model="answer.next">
            </div>
            <div class="col-2">
                <input class="form-control"
                       placeholder="notes"
                       aria-label=""
                        type="text" wire:model="answer.notes">
            </div>
            <div class="col-2">
                <button class="btn btn-primary" wire:click="save">Save</button>
            </div>

                <input type="hidden" wire:model="answer.wizard_id">
                <input type="hidden" wire:model="answer.wizard_question_id">
        </div>
    </form>
</div>
