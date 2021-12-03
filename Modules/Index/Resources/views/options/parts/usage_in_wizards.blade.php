<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        Usage in Wizards
    </div>


    <div class="list-group">
        @forelse( $option->wizard_usage as $use )
            <div class="list-group-item text-center">
                <h3>{{ $use->answer->question->wizard->name }}</h3>
                When the user is asked <strong>"{{ $use->answer->question->text }}"</strong>, and they answer <strong>"{{ $use->answer->text }}"</strong> this option is
                @switch( $use->action )
                    @case('switch_on')
                        <strong class="text-success">turned on</strong>
                        @break
                    @case('increment')
                        <strong class="text-info">increased (or turned on)</strong>
                        @break
                    @case('decrement')
                        <strong class="text-warning">decreased (or turned off)</strong>
                        @break
                    @case('switch_off')
                        <strong class="text-danger">turned off</strong>
                        @break
                @endswitch
                .
                Then they are asked,  <strong>"{{ $use->answer->next_question->text }}"</strong>.
            </div>
        @empty
            <div class="list-group-item list-group-item-secondary text-center">
                Not used in any wizards
            </div>
        @endforelse

    </div>

</div>