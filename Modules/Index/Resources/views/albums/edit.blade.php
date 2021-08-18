@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $album->name ?? "New Album" }}
    </h1> </div>

    <div class="panel-body">
        <form action="{{ url('/albums/'.$album->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <input type="hidden" name="parent_id" value="{{ $album->parent_id }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="name">Album Name</label>
                    <input type="text"
                           name="name"
                           required
                           class="form-control"
                           value="{{ $album->name ?? old('name') ?? '' }}"
                           id="name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="public">Who Can See</label>
                    <select name="public" class="form-control" id="public">
                        @foreach(['0'=>"Malley Only",'1'=>'Accessible to Dealers'] as $k => $v)
                            <option
                                    {{ ( $album->public == $k || $k == old('public') ) ? 'selected' : '' }}
                                    value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <input type="submit"
                           class="btn btn-success"
                           value="Save Album">
                </div>
            </div>
        </form>
    </div>

@endsection



