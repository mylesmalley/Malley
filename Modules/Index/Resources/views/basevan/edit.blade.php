@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $baseVan->name ?? "New Platform" }}
    </h1> </div>

    <div class="panel-body">
        @includeIf('app.components.errors')

        <form action="{{ url('basevan/'.$baseVan->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" value="{{ $baseVan->id }}" name="id">
            <input type="hidden" value="1" name="visibility">
            <div class="row">
                <div class="col-md-5">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') ?? $baseVan->name }}"
                           id="name"
                           class="form-control">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    <input type="submit" value="Create Changes to Platform" class="btn btn-primary">
                </div>
            </div>
        </form>

    </div>

@endsection



