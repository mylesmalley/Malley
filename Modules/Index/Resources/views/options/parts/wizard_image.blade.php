<div class="card border-primary  ">
    <div style="display:inline-block;" class="card-header bg-primary text-white">Image for Wizard

        @if( !$option->obsolete )
            @if( Auth::user()->can_edit_options )

            <a href="{{ route('option.wizard_image.form', [$option]) }}"
               class='btn btn-sm btn-secondary float-end'>Edit</a>
                @endif
        @endif
    </div>

    <div class="card-body">
        @if ( $option->getFirstMedia('wizard_image') )
            <img src="{{ $option->getFirstMedia('wizard_image')->cdnUrl() }}"
                 style="width:100%;"
                 alt="">
        @endif

    </div>

</div>

