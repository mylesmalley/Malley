<div class="card border-primary ">
    <div class="card-header bg-primary text-white">Drawings for Forms and Renderings
        @if( !$option->obsolete )
            @if( Auth::user()->can_edit_options )

            <a href="{{ url('/index/option/'.$option->id.'/drawings') }}"
               class='btn btn-sm btn-secondary float-end'>Edit</a>

                @endif
        @endif
    </div>

    <table class="table table-striped">
        @foreach($option->getMedia('drawings') as $drawing)
            <tr>
                <td>
                    NAME: {{ $drawing->name }} <br>
                    ID #{{ $drawing->id }} <br>
                    USAGE: {{ \App\Models\FormElementItem::where('media_id', $drawing->id)->count() }} TIMES
                    @foreach( $drawing->tags as $tag )
                        <span class="badge bg-primary">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td>
                    <img style="border:1px solid black;"
                         width="185" src="{{ $drawing->cdnUrl() }}"
                         alt="{{ $drawing->name }}" />
                </td>
            </tr>
        @endforeach
    </table>

</div>
