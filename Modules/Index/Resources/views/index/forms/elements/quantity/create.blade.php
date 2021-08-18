@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1> New Checbox List ( Yes or No)
                <a href="{{ url('/index/basevan/'.$basevan->id.'/forms/'.$form->id) }}" class="btn float-right btn-dark btn-lg">Back to {{ $form->name  }}</a>

            </h1>
            <h3 class="text-secondary">{{ $form->name }} Form</h3>
            <h3 class="text-secondary">{{ $basevan->name }}</h3>
        </div>
    </div>


    @includeIf('app.components.errors')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Details</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('index/forms/quantity/create') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="form_id" id="form_id" value="{{ $form->id }}">
                        <input type="hidden" name="type" id="type" value="quantity">
                        <div class="row">
                            <div class="col-6">
                                <label for="label">Label</label>
                                <input type="text" id="label"
                                       name="label"
                                       class="form-control"
                                       value="{{ old('label') }}">
                            </div>

                            <div class="col-3">
                                <label for="indent">Indent</label>
                                <input type="number" id="indent"
                                       name="indent"
                                       class="form-control"
                                       value="{{ old('indent') ?? 0 }}">
                            </div>
                            <div class="col-3 ">
                                <input type="submit" value="Save Quantity Block" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection
