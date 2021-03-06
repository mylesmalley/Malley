@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1>{{ $layout->name }}

                <a href="{{ url('/index/basevan/'.$basevan->id.'/layouts') }}" class="btn float-right btn-dark btn-lg">Back To Layouts</a>
            </h1>
            <h3 class="text-secondary">For {{ $basevan->name }}</h3>

        </div>
    </div>


    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    Active Layout Options
                </div>

                <table class="table  table-sm table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Obsolete?</th>
                            <th>Acctions</th>
                        </tr>
                    </thead>

                    @foreach( $activeOptions as $option )
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td><a href="{{ url('index/option/'.$option->id.'/home') }}">{{ $option->option_name }} r{{  $option->revision  }}</a></td>
                            <td>{{ $option->option_description }}</td>
                            <td>{{ !$option->obsolete ? "Current" : "Obsolete" }}</td>
                            <td>
                                <form
                                    action="{{ url('index/basevan/'.$basevan->id.'/layouts/'.$layout->id ) }}"
                                    method="POST"
                                    >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="option_id" value="{{ $option->id }}" >
                                    <input type="hidden" name="layout_id" value="{{ $layout->id }}" >
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
                    Available Options That Can Be Added
                </div>

                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Obsolete?</th>
                            <th>Acctions</th>
                        </tr>
                    </thead>

                    @foreach( $remainingOptions as $option )
                        <tr>
                            <td>{{ $option->id }}</td>
                            <td><a href="{{ url('index/option/'.$option->id.'/home') }}">{{ $option->option_name }} r{{  $option->revision  }}</a></td>
                            <td>{{ $option->option_description }}</td>
                            <td>{{ !$option->obsolete ? "Current" : "Obsolete" }}</td>
                            <td>
                                <form
                                        action="{{ url('index/basevan/'.$basevan->id.'/layouts/'.$layout->id ) }}"
                                        method="POST" >
                                    {{ csrf_field() }}
                                    <input type="hidden" name="option_id" value="{{ $option->id }}" >
                                    <input type="hidden" name="layout_id" value="{{ $layout->id }}" >
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


