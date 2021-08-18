@extends('vehicles::layout')

@section('content')
<div class="section">
    <h2>Upload Batch</h2>
    <form method="POST"
          enctype="multipart/form-data"
          action="/vehicles/batches">
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

@endsection
