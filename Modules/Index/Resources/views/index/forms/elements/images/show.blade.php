<div class="card">
    <div class="card-header">
        <h4>{{ $element->label }}
            <a href="{{ url('index/forms/imageblock/'.$element->id ) }}"
               class='btn btn-sm btn-outline-dark float-right'>Edit Images</a>


        </h4>
    </div>
    <div class="card-body">

        @foreach($element->items->sortBy('position') as $item)
                <div style="text-align:center; border:1px solid grey; margin:2px; display: inline-block;">

                @if ( $item->media )
                <a href="/index/option/{{ $item->option->id }}/drawings" >

                    <img src="{{ $item->media->cdnUrl() ?? '#' }}" alt="{{ $item->option->nameIdentifier }}" width="200" /><br>
                {{ $item->option->option_name }}</a>
            @else
                <h1>MISSING IMAGE</h1>
            @endif
                </div>

            @endforeach

    </div>
</div>
