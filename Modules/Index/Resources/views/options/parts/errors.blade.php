@if ( $option->obsolete )
    <div class="card border-warning bg-warning text-white">
        <div class="card-header">
            <h2>This option / revision is OBSOLETE</h2>
        </div>
        <div class="card-body">
            This option has been marked as obsolete. The current version is
            @php
                $current = $option->revisions()->first();
            @endphp
            <a href="{{ url("/index/option/{$current->id}/home") }}">{{ $current->fullName }}</a>
        </div>
    </div>

@else

    @if ( $option->errors()->count() )
        <div class="card bg-danger text-white">
            <div class="card-body">
                @if(session('errors'))

                    <h3>Errors</h3>
                <ul>
                    @foreach( session('errors') as $err )
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>

                @endif
                <h3>Potential Problems With This Option</h3>
                <ul>
                    @foreach( $option->errors() as $err )
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

@endif

<br>
