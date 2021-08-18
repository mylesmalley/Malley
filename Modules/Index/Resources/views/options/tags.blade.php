@extends('index::app.main')

@section("content")

    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            @if ( !$option->obsolete )
                @if ($option->previousID)
                    <a href="/index/option/{{ $option->previousId }}/tags" class="btn btn-secondary btn-lg">&lt; Previous</a> &nbsp;
                @endif
                @if ($option->nextID)
                    <a href="/index/option/{{ $option->nextID }}/tags" class="btn btn-secondary btn-lg">Next &gt;</a>
                @endif
            @endif
        </div>
        <div class="input-group">
            <a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
        </div>

        <div class="input-group">
            <a href="{{ url('/index/index/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h1>{{ $option->fullName }} Tags</h1>
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
                    Available Tags
                </div>
                <div class="card-body">
                    @foreach( $availableTags as $tag )
                        @if( array_key_exists( $tag->id, $optionTags ))
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/option/'.$option->id.'/tag/'.$tag->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-secondary" value="{{ $tag->name }}">
                            </form>
                        @else
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/option/'.$option->id.'/tag/'.$tag->id) }}">
                                {{ csrf_field() }}
                                <input type="submit" class="btn btn-outline-secondary" value="{{ $tag->name }}">
                            </form>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


<br>
    <hr>

    <br>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">New Tag</div>
                <div class="card-body">
                    <form method="POST"
                          action="{{ url('/index/'.$option->base_van_id.'/tag') }}"
                          class="form-inline">
                        {{ csrf_field() }}
                        <input type='hidden' name="model" value="option">

                        <div class="form-group">
                            <input type="text"
                                   aria-label="Tag name"
                                   placeholder="New Tag Name"
                                   name="name" id="name"
                                   value=""
                                   class="form-control" />
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" class="btn btn-dark" value="Save new Tag">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
