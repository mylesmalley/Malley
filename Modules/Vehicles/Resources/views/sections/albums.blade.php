<br>
<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        Photos

        @if( Auth::user()->vdb_modify_photos )
            <a href="{{ url('vehicles/'.$vehicle->id.'/albums' ) }}"
               class='btn btn-sm btn-secondary float-end'>Edit Photos</a>
        @endif

    </div>

    <div class="card-body">
        @foreach( $vehicle->albums as $album)
            @foreach( $album->media as $image )
                <div style="display:inline-block;
                            border: 1px solid gray;
                            padding: 5px;">
                    <a href="{{ $image->cdnURL() }}">

                        <img width="100" alt="" src="{{ $image->cdnURL('thumb') }}"  />
                    </a>

                    <br />
                </div>
            @endforeach
        @endforeach
    </div>
</div>
