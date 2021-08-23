<div>
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
        {{ $question->text }}
        <!--                         {{ $question->id }} {{ $wizard->start }}-->

            @if ( $wizard->start != $question->id )
                <button
                        wire:click="back"
                        class="btn btn-sm btn-secondary float-end">Back</button>
                <button
                        wire:click="restart"
                        class="btn btn-sm btn-warning float-end">Restart</button>
            @endif
        </div>
        <div class="card-body">

            @if( $question->type === 'checkboxes' )
                <form  wire:submit.prevent="submitOptions">

                    @foreach( $question->answers as $answer )

                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   wire:model="options"
                                   value="{{ $answer->id}}"
                                   id="chckbox{{ $answer->id }}">
                            <label class="form-check-label" for="chckbox{{ $answer->id }}">
                            {{ $answer->text }}
                            <!--                                {{ $answer->id }}-->
                            </label>
                        </div>
                    @endforeach
                    <input type="submit" class="btn btn-secondary float-end" value="Continue" >
                </form>
            @else
                <ul class="list-group list-group-flush">
                    @foreach( $question->answers as $answer )
                        <li class=" list-group-item"><button class="btn btn-link" wire:click="submitAnswers({{ $answer->id }})">{{ $answer->text }}</button></li>
                    @endforeach
                </ul>

            @endif
        </div>
    </div>
</div>