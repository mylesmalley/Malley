@extends('index::app.main')

@section("content")

    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            @if ( !$option->obsolete )
                @if ($option->previousID)
                    <a href="/index/option/{{ $option->previousId }}/templates" class="btn btn-secondary btn-lg">&lt; Previous</a> &nbsp;
                @endif
                @if ($option->nextID)
                    <a href="/index/option/{{ $option->nextID }}/templates" class="btn btn-secondary btn-lg">Next &gt;</a>
                @endif
            @endif
        </div>
        <div class="input-group">
            <a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
        </div>

        <div class="input-group">
            <a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h1>{{ $option->fullName }} Template Pages</h1>
            <h3 class="text-secondary">{{ $option->option_description }}</h3>
        </div>
    </div>

    <p>
        To add a tag to an option, just click on it's name from the list below.
        Tags that are already assigned are coloured grey.
    </p>

    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Available Templates
                </div>
                <div class="card-body">
                    @foreach( $availableTemplates as $template )
                        @if( array_key_exists( $template->id, $optionTemplates ))
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/option/'.$option->id.'/templates/'.$template->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-secondary" value="{{ $template->name }}">
                            </form>
                        @else
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/option/'.$option->id.'/templates/'.$template->id) }}">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-outline-secondary" value="{{ $template->name }}">
                            </form>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
