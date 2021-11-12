<div>
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
        {{ $question->text }}
        <!--{{ $question->id }} {{ $wizard->start }}-->
        </div>

        @if ( ( $wizard->start == $question->id) && $wizard->start_notes )
            <div class="card-body">
                {!! $wizard->start_notes !!}
            </div>
        @endif

        @if ( $wizard->end && ( $wizard->end == $question->id)  )
            {{--
                what happens when the wizard is complete
             --}}
            <div class="card-body text-center">
                {!! $wizard->end_notes ?? '' !!}
                <br><br>
                <form action="{{ route('blueprint.wizard.submit', [ $blueprint, $wizard]) }}"
                      method="POST">
                        @csrf

                    <input type="submit"
                            class="btn btn-success"
                            value="Save and Continue">
                </form>

            </div>
        @else



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


                    @elseif( $question->type === 'thumbnail_selection' )



                         @foreach( $question->answers as $answer )
                             <a class="list-group-item
                                list-group-item-action
                                text-primary fw-bolder"
                                wire:click="submitAnswers({{ $answer->id }})">


                                 @php
                                 $image = null;
                                    if( $answer->actions && $answer->actions->first() )
                                    {
                                     $image = \App\Models\Media::where(['model_id'=>$answer->actions[0]->option_id,
                                        'model_type'=>'App\Models\Option',
                                        'collection_name'=>'wizard_image'])->first();
                                    }

                                 @endphp
                                 @if ($image)
                                     <img alt="thumbnail"
                                          style="width:200px;"
                                          src="{{ $image->cdnUrl() }}">
                                 @endif




                                 {{ $answer->text }}
                             </a>
                         @endforeach


                    @else



                        @foreach( $question->answers as $answer )
                            <a class="list-group-item
                                list-group-item-action
                                text-primary fw-bolder"
                               wire:click="submitAnswers({{ $answer->id }})">
                                {{ $answer->text }}
                            </a>
                        @endforeach




                    @endif


                    @if ( $wizard->start != $question->id )
                        <div class="list-group-item">
                                <span class="float-start">
                                    <button
                                            wire:click="restart"
                                            class="btn btn-sm btn-outline-danger ">
                                        Restart Wizard
                                    </button>

                                         &nbsp;
                                    <button
                                            wire:click="back"
                                            class="btn btn-sm btn-outline-secondary">
                                        Previous Question
                                    </button>
                                </span>
                            <a href="{{ route('blueprint.home', [ $blueprint->id ]) }}"
                               class="btn btn-sm btn-secondary float-end">Save and Come Back Later</a>
                        </div>
                    @endif
                </div>

             </form>
        @endif

    </div>
</div>