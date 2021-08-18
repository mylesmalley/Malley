@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $document->name ?? "New Document" }}
    </h1> </div>

    <div class="panel-body">
        <form action="{{ url( '/documents/'.$document->id ) }}" method="POST">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-5">
                    <label for="name">Rename To</label>
                    <input type="text"
                           class='form-control'
                           name="name" id="name" value="{{ old('name') ?? $document->name ?? "" }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <select name="category"
                            class='form-control'
                            id="category">
                        @foreach([''=>'None', 'ambulance'=>'Ambulance',"mobility"=>'Mobility',"plastics"=>'Plastics','blank'=>"Blank"] as $key => $value)
                            <option
                                {{ old('category') === $key || $document->category === $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>

        </form>
    </div>

@endsection



