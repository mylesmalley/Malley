@extends('index::app.main')


@section("content")
    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

{{--        @includeIf('index::options.components.partials.revisionForm')--}}

        <div class="input-group">
            <a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
        </div>

{{--        <div class="input-group">--}}
{{--            <a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>--}}
{{--        </div>--}}

    </div>

    <div class="row">
        <div class="col-12">
            <h1>{{ $option->fullName }} Components</h1>
            <h3 class="text-secondary">{{ $option->option_description }}</h3>
        </div>
    </div>


    @if ($message = \Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = \Session::get('error'))
        <div class="alert alert-danger  alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @includeIf('app.components.errors')


    <div class="row">
        <div class="col-6">
            @includeIf('index::options.components.partials.sysproComponentsList')
            @includeIf('index::options.components.partials.importComponentsForm')

        </div>

        <div class="col-6">
                @includeIf('index::options.components.partials.stagedComponentsList')
                <br>
                @includeIf('index::options.components.partials.addComponentForm')
                <br>
                @includeIf('index::options.components.partials.revisionForm')
        </div>


    </div>




@endsection
