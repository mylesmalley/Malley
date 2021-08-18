@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $document->name ?? "New Document / Folder" }}
    </h1> </div>

    <div class="panel-body">

        @includeIf('app.components.errors')

        <form action="/documents" method="POST">
            {{ csrf_field() }}
            <input type="hidden"  name="parent_id" value="{{ $parent_id }}">
            <input type="hidden" name="visible" value="{{ true }}">
            <div class="row">
                <div class="col-md-5">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') ?? $document->name ?? "" }}"
                           class="form-control">
                </div>
            </div>

            <div class="row">
                <div class='col-md-3'>
                    <label for="category">Category</label>
                    <select name="category"
                            id="category"
                            class="form-control">
                        @foreach([''=>'None', 'ambulance'=>'Ambulance',"mobility"=>'Mobility',"plastics"=>'Plastics','blank'=>"Blank"] as $key => $value)
                            <option value="{{ $key }}"
                                    @if (old('category') && old('category') == $key
									)
                                    selected
                                    @endif
                            >{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <input type="submit" class="btn btn-primary" value="Save Document / Folde">
                </div>
            </div>
        </form>

    </div>

@endsection
