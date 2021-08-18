@extends('index::app.main')

@section("content")

    <div class='row'>
        <div class='col-12'>
            <h1>
                Tags for
            </h1>


        </div>
    </div>
    <p>
        To add a tag to an option, just click on it's name from the list below.
        Tags that are already assigned are coloured grey.
    </p>

    @includeIf('vehicles::errors')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Drawing
                </div>
                <div class="card-body">
                    <img style="border: 1px solid black;" width="400" src="{{ $media->cdnUrl() }}" alt="{{ $media->name }}" />

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Available Tags
                </div>
                <div class="card-body">
                    @foreach( $availableTags as $tag )
                        @if( array_key_exists( $tag->id, $drawingTags ))
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/media/'.$media->id.'/tag/'.$tag->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-secondary" value="{{ $tag->name }}">
                            </form>
                        @else
                            <form method="POST"
                                  style="display:inline;"
                                  action="{{ url('/index/media/'.$media->id.'/tag/'.$tag->id) }}">
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
                          action="{{ url('/index/basevan/'.$option->base_van_id.'/tag') }}"
                          class="form-inline">
                        {{ csrf_field() }}
                        <input type='hidden' name="model" value="drawing">
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
