<div class="card border-primary  ">
    <div style="display:inline-block;" class="card-header bg-primary text-white">Image for Wizard

        @if( !$option->obsolete )
            @if( Auth::user()->can_edit_options )

            <a href="{{ route('option.wizard_image.get', [$option]) }}"
               class='btn btn-sm btn-secondary float-end'>Edit</a>
                @endif
        @endif
    </div>

    <div class="card-body">
        @if ( $option->getFirstMedia('wizard_image') )
            <img width="185"
                 alt="wizard iamge"
                 src="{{ $option->getFirstMedia('wizard_image')->cdnURL() }}"  />
        @endif

    </div>

</div>

