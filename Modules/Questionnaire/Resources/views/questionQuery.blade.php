<div>
    @if( $question)
        <div class="card">
            <div class="card-header">
                Question
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        <input class="form-control form-control-sm"
                                type="text" wire:model="question.text" >
                    </div>
                    <div class="col-2">
                        <button wire:click="saveText()" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>