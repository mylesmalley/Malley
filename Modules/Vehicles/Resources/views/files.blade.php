@extends('vehicles::layout')

@section('content')
    <h1 class="text-center">Edit Uploaded Files</h1>
    <h2 class="text-center text-secondary">For <a href="{{ url('vehicles/'.$vehicle->id) }}">
        {{ $vehicle->identifier }}
        </a></h2>

    @includeIf('vehicles::errors')

    <div class="card border-primary document-content-wrapper">
        <div class="card-body">

        <h2>Upload New Files</h2>
        <form method="POST"
              enctype="multipart/form-data"
              action="/vehicles/{{ $vehicle->id }}/files">
            {{ csrf_field() }}

            <input type="hidden" name="visible" value="1">
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
            <br>
            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="Upload Files">
                </div>
            </div>
        </form>

        </div>
    </div>


    <br>
    <div class="card border-primary document-content-wrapper">
        <div class="card-header bg-primary text-white">
            Existing Files
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Date Uploaded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse( $vehicle->media as $media )
                    <tr>
                        <td>
                            <a href="{{ $media->cdnUrl() }}" download>
                                {{ $media->file_name }}
                            </a>
                        </td>
                        <td>{{ $media->updated_at }}</td>
                        <td>
                            <form method="POST" action="/vehicles/{{ $vehicle->id}}/media/{{ $media->id }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}


                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </div>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No Files</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <br>
    <div class="text-center">
        <a href="{{ url('vehicles/'.$vehicle->id) }}"
           class="btn btn-primary">Back to {{ $vehicle->identifier }}</a>
    </div>

@endsection
