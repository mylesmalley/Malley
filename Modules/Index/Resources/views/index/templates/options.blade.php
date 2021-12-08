@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>{{ $template->name }}

                <a href="{{ url('/index/basevan/'.$basevan->id.'/templates') }}" class="btn float-right btn-dark btn-lg">Back To Templates</a>
            </h1>
            <h3 class="text-secondary">For {{ $basevan->name }}</h3>

        </div>
    </div>


    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    Active Template Options
                </div>

                <div class="card-body">
                    <p>These options will appear on this drawing page if they are selected when configuring a Blueprint</p>
                </div>
                <table class="table  table-sm table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Obsolete?</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    @foreach( $activeOptions as $option )
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td><a href="{{ route('option.home', [ $option ] ) }}">{{ $option->option_name }} r{{  $option->revision  }}</a></td>
                            <td>{{ $option->option_description }}</td>
                            <td>{{ !$option->obsolete ? "Current" : "Obsolete" }}</td>
                            <td>
                                <form
                                        action="{{ route('platform.template.option.delete', [$basevan, $template]) }}"
                                        method="POST"
                                >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="option_id" value="{{ $option->id }}" >
                                    <input type="hidden" name="template_id" value="{{ $template->id }}" >
                                    <input type="submit" class="btn btn-outline-danger" value="Delete">
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <br>



    <div class="row">
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    Available Options That Can Be Added To This Template
                </div>

                <table class="table table-sm table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Obsolete?</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    @foreach( $remainingOptions as $option )
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td><a href="{{ route('option.home', [ $option ] ) }}"
                                >{{ $option->option_name }} r{{  $option->revision  }}</a></td>
                            <td>{{ $option->option_description }}</td>
                            <td>{{ !$option->obsolete ? "Current" : "Obsolete" }}</td>
                            <td>
                                <form
                                        action="{{ route('platform.template.option.add', [$basevan, $template]) }}"
                                        method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="option_id" value="{{ $option->id }}" >
                                    <input type="hidden" name="template_id" value="{{ $template->id }}" >
                                    <input type="submit" class="btn btn-outline-success" value="ADD">
                                </form>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>




@endsection


