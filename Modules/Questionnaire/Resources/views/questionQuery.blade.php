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
                <div class="row"></div>
                <h3 >Answers</h3>
                <table class="table table-sm table-striped">
                    @foreach( $question->answers as $answer )
                        <tr>
                            <td>{{ $answer->text }}</td>
                            <td>Next Question: <button class="btn btn-link" wire:click="pickQuestionById( {{$answer->next}} )">
                                    {{ \App\Models\WizardQuestion::find( $answer->next )->text }} ({{ $answer->next }})
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    <div class="col-9 offset-3">

                                        <h5>Actions</h5>
                                        <table class="table table-sm table-striped">
                                            @foreach( $answer->actions as $action)
                                                <tr>
                                                    <td>{{ $action->action }}</td>
            {{--                                        <td>{{ $action->option_id }}</td>--}}
                                                    <td>{{ $action->option->option_description }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                </div>

                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>

        </div>

    @endif
</div>