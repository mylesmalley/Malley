@extends('index::app.main')


@section("content")


    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            @if ( !$option->obsolete )
                @if ($option->previousID)
                    <a href="/index/option/{{ $option->previousId }}/usage" class="btn btn-secondary btn-lg">&lt; Previous</a> &nbsp;
                @endif
                @if ($option->nextID)
                    <a href="/index/option/{{ $option->nextID }}/usage" class="btn btn-secondary btn-lg">Next &gt;</a>
                @endif
            @endif
        </div>
        <div class="input-group">
            <a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
        </div>

        <div class="input-group">
            <a href="{{ url('/index/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <h1>{{ $option->fullName }} Usage in Blueprint</h1>
            <h3 class="text-secondary">{{ $option->option_description }}</h3>
        </div>
    </div>


    @includeIf('app.components.errors')


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Usage in Active Blueprints
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Creator</th>
                            <th>Dealer</th>
                            <th>Selected?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $configs as $config )
                            <tr onclick="window.location = 'https://blueprint.malleyindustries.com/blueprint/{{ enc( $config->blueprint->id  ) }}'">
{{--                                <td>{{ $config->id }}</td>--}}
                                <td>B-{{ $config->blueprint->id }}</td>
                                <td>{{ $config->blueprint->name }}</td>
                                <td>{{ $config->blueprint->user->first_name }} {{ $config->blueprint->user->last_name }}</td>
                                <td>{{ $config->blueprint->user->company->name }}</td>
                                @if( $config->value )
                                    <td class="bg-success text-white"> Selected</td>
                                @else
                                    <td class="bg-danger text-white">Not Selected</td>
                                @endif
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
