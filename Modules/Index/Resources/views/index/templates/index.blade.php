@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }} Templates
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')


    <div class="card border-primary">
    @includeIf('index::index.partials.tabs', ['selected' => 'templates'])



    <script>

    </script>
    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Options</th>
            <th>Template</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $templates as $template )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $template->name }}</td>
                <td>@if (strpos( $template->template, "@OPTIONS@" ) !== false )
                        <a class="btn btn-sm btn-info"
                                href="{{ url("/index/basevan/{$basevan->id}/templates/{$template->id}/options") }}">Edit Options</a>
                    @endif
                  </td>
                <td>

                    <a
                            class="btn btn-sm btn-warning"
                            href="{{ url("/index/basevan/{$basevan->id}/templates/{$template->id}") }}">Edit Template</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>

@endsection
