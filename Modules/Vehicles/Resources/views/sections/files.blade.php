<div class="card border-primary">
    <div class="card-header bg-primary text-white" >

        Files and Documents

        <a href="{{ url('vehicles/'.$vehicle->id.'/files' ) }}"
           class='btn btn-sm btn-secondary float-end'>Edit Files</a>

    </div>
    <table class="table table-striped table-sm">

        <tbody>
                    @if( Auth::user()->vbd_modify_documents )
                        <tr>
                            <td style="text-align: center">
                                <a href="{{ url('vehicles/'.$vehicle->id.'/documents' ) }}" class='btn btn-secondary'>Inspection Documents &amp; Stickers</a>
                                &nbsp;&nbsp;
                            </td>
                        </tr>

                    @endif

        @forelse( $vehicle->media as $media )
            <tr>
                <td>
                    <a href="{{ $media->cdnUrl() }}" download>
                        {{ $media->file_name }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="1">No Files</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
