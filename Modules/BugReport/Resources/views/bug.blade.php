@extends('bugreport::template')
@section('content')


    @if( Auth::user()->bug_report_editor && $mode === 'editBug' )
        <div class="text-center">

        @if( $bug->engineering_task )
            <h1>Project #{{ $bug->id }} {{ $bug->title }}</h1>
            <h2 class="text-secondary">{{ $bug->status }}</h2>
        @else
            <h1>Bug #{{ $bug->id }}</h1>
            <h2 class="text-secondary">{{ $bug->status }}</h2>
        @endif
        </div>

        @includeIf('bugreport::bugs.edit')
    @else
        <h1 class="text-center">Project #{{ $bug->id }} {{ $bug->title }}</h1>
        <h2 class="text-secondary text-center">{{ $bug->urgencyLabel }} - {{ $bug->status }}</h2>


                @if( Auth::user()->bug_report_editor && !$mode )
                    <a href="{{ url('bugs/'.$bug->id.'/editBug' ) }}" class='btn btn-success text-center'>Edit Details</a>
                @endif

        <div class="card border-primary document-content-wrapper">
            <div class="card-body">

        @includeIf('bugreport::bugs.show' )

            </div>
        </div>
    @endif



    @includeIf('bugreport::errors')


<br>

    @if( Auth::user()->bug_report_editor && $mode === 'editActivities' )
        <h3 class="text-center">Tasks</h3><br>
        <div class="card border-primary document-content-wrapper">
            <div class="card-body">
        @includeIf('bugreport::activities.edit', ['activities' => $bug->activities])
            </div>
        </div>
    @else




        <h3 class="text-center">Tasks <br>
            @if( Auth::user()->bug_report_editor && !$mode )
                <a href="{{ url('bugs/'.$bug->id.'/editActivities' ) }}" class='btn btn-secondary float-right'>Edit Activities</a>
           @endif
        </h3>
                <div class="card border-primary document-content-wrapper">
                    <div class="card-body">

       @includeIf('bugreport::activities.show', ['activities' => $bug->activities])

                    </div>
                </div>
    @endif


@endsection
