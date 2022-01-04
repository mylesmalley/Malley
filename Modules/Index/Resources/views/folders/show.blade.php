@extends('index::app.main')

@section('content')

    <div class="card">


        <div class="card-heading text-center">
            <h2 class="display-3">Folder "{{ $folder->name ?? 'NAME??' }}"</h2>

        </div>
        @forelse( $folder->ancestors as $ancestor )
            <a href="/folders/{{ $ancestor->id }}">{{ $ancestor->name ?? 'ancestor' }}</a>	&gt
        @empty
            <a href="/folders/">Uploads</a>	&gt
        @endforelse

        <div class="row" >

            <div class="col-md-4">
                <h3 class="">Folders</h3>

                <ul class="list-group list-group-flush">
                    @foreach( $folder->children->sortBy('name') as $child )
                        <li class="list-group-item">
                            <a href="{{ url('/folders/'.$child->id) }}">{{ $child->name ?? 'ancestor' }}
                            </a>

                                @if ( $child->media->count() === 0 && $child->children()->count() === 0 )
                                    <form method="POST"
                                          style="display:inline-block;"
                                          action="{{ url( "folders/". $child->id.'/delete' ) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-danger btn-sm text-right" value="x">
                                    </form>
                                @endif


                        </li>
                    @endforeach
                </ul>
                <hr>

                <h4 class="">Add Folder</h4>

                <form method="POST"
                      action="{{ url( "folders/". $folder->id.'/create' ) }}">
                    {{ csrf_field() }}

                    <div class="form-group col-sm-10">
                        <input type="text"
                               aria-label=""
                               id="name"
                               name="name"
                               required
                               class="form-control"
                        >
                        <input type="submit" class="btn btn-primary" value="Add Folder">

                    </div>

                </form>
            </div>

            <div class="col-md-8">
                <h3 class="">Files</h3>

                <ul class="list-group list-group-flush">
                    @foreach( $folder->media->sortBy('file_name') as $media )
                        <li class="list-group-item">

                            <a class="" href="{!! $media->cdnUrl() !!}">{{ $media->file_name }}</a>

                            <form method="POST"
                                  style="display:inline-block;"
                                  action="{{ url( "files/". $media->id.'/delete' ) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                <input type="submit" class="btn btn-danger btn-sm text-right" value="x">
                            </form>
                        </li>
                    @endforeach
                </ul>

                <h4 class="">Add File</h4>
                @includeIf('app.components.errors')

                <form method="POST"
                      enctype="multipart/form-data"
                      action="{{ url( "folders/". $folder->id.'' ) }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-5">
                            <input
                                max="4096"
                                name="upload[]"
                                multiple
                                type="file"
                                class="form-control" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary" value="Upload Files">
                        </div>
                    </div>
                </form>

            </div>

        </div>


    </div>


    @endsection
