<div class="card
    @if( $option->show_on_templates && ! count( $option->templates) )
        border-danger
            @else
        border-primary
    @endif

">
    <div class="card-header
    @if( $option->show_on_templates && ! count( $option->templates) )
        bg-danger text-white
            @else
        bg-primary text-white
    @endif
">
        Shown on Render Pages

        @if( !$option->obsolete && $option->show_on_templates )
            @if( Auth::user()->can_edit_options )

                <a href="{{ url('/index/option/'.$option->id.'/templates') }}"
                   class='btn btn-sm btn-secondary float-end'>Edit</a>

            @endif
        @endif
    </div>
    <div class="card-body">
        @if ( count( $option->templates) )
        <ul>
            @foreach( $option->templates as $template )
            <li><a href="/index/basevan/{{$option->base_van_id}}/templates/{{ $template->id }}/options">{{ $template->name }}</a></li>
            @endforeach
        </ul>
            @elseif( !$option->show_on_templates )
            <p>This option isn't expected to appear on templates.</p>
        @else
    Not shown on any templates
        @endif
    </div>
</div>
