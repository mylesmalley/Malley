<div>
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
        {{ $question->text }}
        <!--{{ $question->id }} {{ $wizard->start }}-->
        </div>

             <form wire:submit.prevent="submitOptions">
                 <div class="list-group">

                @if( $question->type === 'checkboxes' )

                        @foreach( $question->answers as $answer )
                            <div class="list-group-item">
                                <input class="form-check-input"
                                       type="checkbox"
                                       wire:model="options"
                                       value="{{ $answer->id}}"
                                       id="chckbox{{ $answer->id }}">
                                <label class="form-check-label
                                                text-primary fw-bolder "

                                       for="chckbox{{ $answer->id }}">
                                    {{ $answer->text }}
                                </label>
                            </div>

                        @endforeach

                        <div class="list-group-item">
                            <input type="submit"
                                   class="btn btn-secondary float-end"
                                   value="Continue" >
                        </div>

                    @else



                        @foreach( $question->answers as $answer )
                            <a class="list-group-item
                                list-group-item-action
                                text-primary fw-bolder"
                               wire:click="submitAnswers({{ $answer->id }})">
                                {{ $answer->text }}
                            </a>
                        @endforeach

                        @if ( $wizard->start != $question->id )
                            <div class="list-group-item">
                                <button
                                    wire:click="back"
                                    class="btn btn-sm btn-secondary float-end">Back</button>
                                <button
                                    wire:click="restart"
                                    class="btn btn-sm btn-warning float-start">Restart</button>
                            </div>
                        @endif


                    @endif
                </div>

             </form>
    </div>
</div>