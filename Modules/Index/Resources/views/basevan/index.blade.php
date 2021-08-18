@extends('index::app.main')

@section("content")

		<nav aria-label="breadcrumb" role="navigation">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Platforms</li>
			</ol>
		</nav>

	<h1>Platforms</h1>
	<table class='table table-striped table-hover'>
		@foreach($basevans as $basevan)
			<tr>
				<td>{{ $basevan->name }}</td>
				<td align="right">
					<div class="btn-group">
					  <button class="btn btn-primary btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Actions
					  </button>
					    <div class="dropdown-menu">
					      <a class="dropdown-item" href="index/{{ $basevan->id }}">Options</a>
					      <a class="dropdown-item" href="index/{{ $basevan->id }}/edit">Edit Platform</a>
					      <a class="dropdown-item" href="index/{{ $basevan->id }}/templates">Rendering Templates</a>
						    <a class="dropdown-item" href="index/{{ $basevan->id }}/layouts">Vehicle Layouts</a>
						    <a class="dropdown-item" href="index/{{ $basevan->id }}/forms">Blueprint Forms</a>
					    </div>
					</div>
				</td>
			</tr>
		@endforeach
	</table>
		@optionEditor
	<a href="{{ url('basevan/create') }}" class="btn btn-primary">New Platform</a>
		@endoptionEditor
@endsection
