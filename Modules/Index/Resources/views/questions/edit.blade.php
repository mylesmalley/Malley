@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $question->question ?? "New Question" }}
    </h1> </div>

    <div class="panel-body">

        @includeIf('app.components.errors')

        <form action="{{ url('/questions/'.$question->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" id="id" value="{{ $question->id }}">

            <div class="row">
                <div class="col-md-5">
                    <label for="question">Rename Question To</label>
                    <input type="text" name="question"
                           class="form-control"
                           id="question" value="{{ old('question') ?? $uestion->question ?? "" }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <label for="layout_id">Layout</label>
                    <select name="layout_id"
                            class="form-control"
                            id="layout_id">
                        @foreach(\App\Models\BaseVan::layoutMenu() as $platform => $layouts)
                            <optgroup label="{{ $platform }}">
                                @foreach( $layouts as $id => $name )
                                <option
                                    {{ old('layout_id') === $id || $id === $question->layout_id ? "selected" : "" }}
                                    value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <label for="category">Category</label>
                    <select name="category"
                            class="form-control"
                            id="category">
                        @foreach([''=>'None', 'ambulance'=>'Ambulance',"mobility"=>'Mobility',"plastics"=>'Plastics','blank'=>"Blank"] as $k => $v)
                            <option
                                    {{ old('category') === $k || $k === $question->category ? "selected" : "" }}
                                    value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-md-5">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>
        </form>
    </div>

@endsection



