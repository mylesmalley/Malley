<div>
    @if( $question)
        <div class="card">
            <div class="card-header">
                Question
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <input class="form-control form-control-sm"
                               aria-label=""
                                type="text" wire:model="question.text" >
                    </div>
                    <div class="col-3">
                        <select wire:model="question.type"
                                aria-label=""
                                class="form-control">
                            <option value="selection">Swlection</option>
                            <option value="redirect">Redirect</option>
                            <option value="checkboxes">Checkoxes</option>
                            <option value="thumbnail_selection">Thumbnail Selection</option>
                        </select>
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
                            <td>
                                @if ( ! $answer->actions->count() )
                                <button wire:click="deleteAnswer({{$answer->id}})"
                                        class="btn btn-danger btn-sm">
                                    Delete Answer
                                </button>
                                    @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-9 offset-3">

                                        <h5>Actions</h5>
                                        <table class="table table-sm table-striped">
                                            @foreach( $answer->actions as $action)
                                                <tr
                                                    @switch( $action->action)
                                                        @case('switch_on')
                                                             class="table-success"
                                                        @case('switch_off')
                                                            class="table-danger"
                                                        @default
                                                            class="table-info"
                                                        @endswitch
                                                >
                                                    <td>{{ $action->action }}</td>
            {{--                                        <td>{{ $action->option_id }}</td>--}}
                                                    <td>
                                                        <a href="{{ route('option.home', [$action->option]) }}">
                                                            {{ $action->option->option_name }} - {{ $action->option->option_description }}
                                                        </a>
                                                    </td>

                                                    <td><button
                                                            wire:click="deleteAction({{ $action->id }})"
                                                            class="btn btn-sm btn-danger">Delete Action</button></td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3">
                                                    @livewire('questionnaire::new-action', ['answer'=>$answer],key( $answer->id ))

                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="3">
                                @livewire('questionnaire::new-answer', ['question'=>$question],key( $question->id ))

                            </td>
                        </tr>
                </table>
            </div>

        </div>

    @endif
</div>