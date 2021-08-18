<div  class="col-12" style="display:{{ ($letter && !$user) ? 'block' : 'none' }};" >
    @if( $letter && !$user )
        <div class="card border-primary">
            <!-- Employee Picker -->
            <div class="card-header bg-primary text-white">
                <h1>{{ $letter }} Staff
                    <button
                        dusk="deselectLetter"
                        wire:click="deselectLetter" class="btn btn-secondary float-end">Back</button>
                </h1>
            </div>
            <div class="card-body">

                @foreach( $users as $u )
                    <button
                        wire:click="selectUser({{ $u->id }})"
                        dusk="select-{{ $u->first_name }}-{{ $u->last_name }}"
                        class="btn btn-secondary">{{ $u->first_name . ' ' . $u->last_name }}</button>
                @endforeach
            </div>

        </div>
    @endif
</div>
