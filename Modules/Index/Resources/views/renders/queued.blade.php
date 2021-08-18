@extends('index::app.main')

@section('content')
    <div class="panel-heading panel-success">
    	<h1> Render </h1>
        <a href='{{ url('blueprint/'.enc($blueprint->id )) }}' class='btn btn-default btn-sm' >Go Back</a>
    </div>
    <div class="panel-body">
    	Your Blueprint drawings are being generated. This process can take a few minutes. You'll receive an email when they are ready. <a href='{{ url('blueprint/'.enc($blueprint->id) ) }}' >Back to my Blueprint.</a>

    </div>




@endsection
