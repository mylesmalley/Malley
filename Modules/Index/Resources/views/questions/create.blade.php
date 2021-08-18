@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>
      {{ $question->question ?? "New Question" }}
    </h1> </div>

    <div class="panel-body">
        <form action="{{ url('/questions') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="parent_id" value="{{ $parent_id }}">

            <div class="row">
                <div class="col-md-6">
                    <label for="question">Question</label>
                    <input type="text" name="question" id="question" value="{{ old('question') ?? "" }}">
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
                                        {{ old('layout_id') === $id ? "selected" : "" }}
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
                                {{ old('category') === $k  ? "selected" : "" }}
                                value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <input type="submit" class="btn btn-primary " value="Save Question">
            </div>
        </div>
        </form>

    </div>

@endsection
