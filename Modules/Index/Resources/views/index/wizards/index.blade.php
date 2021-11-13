@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }} Wizards
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')


    <div class="card border-primary">
        @includeIf('index::index.partials.tabs', ['selected' => 'wizards'])

        <script>

        </script>
        <table class="table table-striped table-hover table-sm">
            <thead>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach( $wizards as $wizard )
                <tr>
                    <td>{{ $wizard->name }}</td>
                    <td>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
