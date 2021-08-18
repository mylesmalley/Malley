@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            {{ $basevan->name }}
{{--            (Showing {{ $total }})--}}
        </h1>
    </div>

{{--    <div class="row">--}}
{{--        <h3>Option Index ({{ $total }})</h3>--}}
{{--    </div>--}}
<br>

    @includeIf('app.components.errors')

    @includeIf('index::index.partials.tabs', ['selected' => 'options'])

    <div class="card border-primary">

    <div class="card-header">
        @includeIf('index::index.partials.filter')
    </div>


    <script>
        function loacOption( id )
        {
            window.location.href = `{{ url('/index/option' ) }}/${ id }/home`;
        }
    </script>
    <table class="table table-striped table-hover table-sm">
        @includeIf('index::index.partials.header')
        <tbody>
            @each('index::index.partials.row', $options, 'option' )
        </tbody>
    </table>

    </div>


@endsection
