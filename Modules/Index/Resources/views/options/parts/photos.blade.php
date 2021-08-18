<div class="card border-primary  ">
    <div style="display:inline-block;" class="card-header bg-primary text-white">Photos of the Option In Use

        @if( !$option->obsolete )
            @if( Auth::user()->can_edit_options )

            <a href="{{ url('/index/option/'.$option->id.'/photos') }}"
               class='btn btn-sm btn-secondary float-end'>Edit</a>
                @endif
        @endif
    </div>

    <div class="card-body">

        @foreach( $option->getMedia('photos')  as $image )
            <div style="display:inline-block;
                            border: 1px solid gray;
                            padding: 5px;">
                <a href="{{ $image->cdnURL() }}">
                    <img width="185" alt="" src="{{ $image->cdnURL() }}"  />
                </a>
            </div>
        @endforeach
    </div>

</div>

