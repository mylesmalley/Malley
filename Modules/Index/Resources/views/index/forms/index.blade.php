@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }}
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')

    <div class="card border-primary">

    @includeIf('index::index.partials.tabs', ['selected' => 'forms'])



    <script>

    </script>
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Visible to</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $forms as $form )
            <tr onclick="window.location.href = '{{ url("index/basevan/".$basevan->id."/forms/".$form->id) }}'">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $form->name }}</td>
                <td>{!!  $form->visibility ? "<span class='text-success'>Everyone</span>"
                    : "<span class='text-warning'>Only Malley Staff</span>" !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>



@endsection
