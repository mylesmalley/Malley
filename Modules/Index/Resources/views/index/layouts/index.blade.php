@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }} Layouts
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')


    <div class="card border-primary">

    @includeIf('index::index.partials.tabs', ['selected' => 'layouts'])



    <script>

    </script>
    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Thumbnail</th>
            <th>Path</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $layouts as $layout )
            <tr onclick="window.location.href = '{{ url("index/basevan/".$basevan->id."/layouts/".$layout->id) }}'">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $layout->name }}</td>
                <td>
                    @if ($layout->media->first())
                        <img width="200" src="{{ $layout->media->first()->cdnUrl() }}" alt="img" />
                    @endif
                </td>
                <td>
                    @if ( $layout->questions)
                        @foreach( $layout->questions as $question)
                            @foreach( $question->ancestors as $ancestor)
                                {!!  str_repeat( '&nbsp;&nbsp;' , $loop->iteration) !!}{{ $ancestor->question }} <br>
                            @endforeach
                        @endforeach
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>


@endsection
