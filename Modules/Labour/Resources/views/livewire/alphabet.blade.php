<div style="display:{{ (!$letter) ? 'block': 'none' }};">
    <!-- alphabet-component -->

@if( !$letter )
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h1>First Letter of Last Name</h1>
            </div>
            <div class="card-body">

                @foreach( range("A", "Z") as $letter)
                    <button
                        dusk="alphabet-button-{{ $letter }}"
                        wire:click="selectLetter('{{ $letter }}')" style="margin:4px;" class="btn btn-lg btn-secondary">{{ $letter }}</button>
                @endforeach
            </div>

        </div>
    @endif
</div>
