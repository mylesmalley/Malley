@extends('index::app.main')

@section("content")






    <div class="row">
        <div class="col-12 text-center">
            <h1>{{ $option->fullName }}</h1>
            <h3 class="text-secondary">{{ $option->option_description }}</h3>
        </div>
    </div>






    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            @if ( !$option->obsolete )
                @if ($option->previousID)
                    <a href="/index/option/{{ $option->previousId }}/home" class="btn btn-secondary btn-sm">&lt; Previous</a> &nbsp;
                @endif
                @if ($option->nextID)
                    <a href="/index/option/{{ $option->nextID }}/home" class="btn btn-secondary btn-sm">Next &gt;</a>
                @endif
            @endif
        </div>

        @if ( !$option->obsolete )

            <div class="input-group">
                @if( Auth::user()->can_edit_options )
                    <a href="{{ url("/index/option/{$option->id}/revision") }}" class="btn btn-secondary btn-sm">New Revision</a>
                    {{--            <div class="input-group">--}}
                    {{--                <form method="POST" action="{{ url("option/{$option->id}/delete") }}">--}}
                    {{--                    {{ csrf_field() }}--}}
                    {{--                    {{ method_field('DELETE') }}--}}
                    {{--                    <input type="submit" class="btn btn-danger btn-lg" value="DELETE OPTION">--}}

                    {{--                </form>--}}
                    {{--            </div>--}}


                @endif

                @if ( Auth::user()->is_admin
                        && !count($option->formElementItems )
                        && ! count( $option->templates)  )
                    &nbsp;
                    <a href="{{ url("/index/option/{$option->id}/retire") }}" class="btn btn-warning btn-sm">Retire Option</a>


                @endif
            </div>
        @else
            @if( $user->id === 3)
                <div class="input-group">
                    <form method="POST" action="{{ url("/index/option/{$option->id}/delete") }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger btn-sm" value="DELETE OPTION">

                    </form>
                </div>
            @endif
        @endif

        <div class="input-group">
            {{--            <a href="" class="btn btn-secondary btn-lg">Settings</a> &nbsp;--}}
            <a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-sm">Back To Index</a>
        </div>

    </div><br>









    @if ( session('info') && count(session('info')) )
        <div class="row">
            <div class="col-12">
                <div class="card bg-info text-white">
                    <div class="card-body">

                        <h3>Just so you know...</h3>
                        <ul>
                            @foreach( session('info') as $err )
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endif
    <div class="row">
        <div class="col-12">

            @includeIf('index::options.parts.errors')
        </div>

    </div>



    {{--    <h2>About</h2>--}}
    <div class="row">
        <div class="col-8">
            @includeIf('index::options.parts.info')
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    @includeIf('index::options.parts.inventory')
<br>
                </div>
                <div class="col-12">
                    @includeIf('index::options.parts.sales')
                </div>
            </div>
        </div>

    </div>
    <br>


    @if ( $option->no_components == false )
        {{-- only show this element if the option is supposed to have components --}}
        <h2>Components</h2>
        <div class="row">
            <div class="col-md-12">
                @includeIf('index::options.parts.components')
            </div>
        </div>
        <br>
    @endif

    <h2>Rules</h2>
    <div class="row">
        @includeIf('index::options.parts.rules')
    </div>
    <br>


    <h2>Usage</h2>

    <div class="row">
        <div class="col-4">
            @includeIf('index::options.parts.useInForms')
        </div>
        <div class="col-4">
            @includeIf('index::options.parts.usedInTemplates')
        </div>
        <div class="col-4">
            @includeIf('index::options.parts.blueprintUsage')
        </div>
    </div>

    <br>
    <h2>Revision History</h2>
    <div class="row">
        <div class="col-12">

        @includeIf('index::options.parts.revisions')
        </div>

    </div>

    <h2>Media</h2>
    <div class="row">
        <div class="col-6">

        @includeIf('index::options.parts.drawings')
        </div>
            <div class="col-6">

        @includeIf('index::options.parts.photos')
            </div>

    </div>

@endsection
