@extends('index::app.main')

@section("content")


	<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group" role="group" aria-label="First group">
			@if ( !$option->obsolete )
				@if ($option->previousID)
					<a href="{{ route('option.wizard_image.form', [$option->previousID]) }}" class="btn btn-secondary btn-lg">&lt; Previous</a> &nbsp;
				@endif
				@if ($option->nextID)
					<a href="{{route('option.wizard_image.form', [$option->nextID]) }}" class="btn btn-secondary btn-lg">Next &gt;</a>
				@endif
			@endif
		</div>
		<div class="input-group">
			<a href="{{ route('option.home', [$option]) }}" class="btn btn-dark btn-lg">Back to Option</a>
		</div>

		<div class="input-group">
			<a href="{{ route('platform.home', [$option->base_van_id]) }}" class="btn btn-dark btn-lg">Back To Index</a>
		</div>

	</div>

	<div class="row">
		<div class="col-12">
			<h1>{{ $option->fullName }} Wizard Image</h1>
			<h3 class="text-secondary">{{ $option->option_description }}</h3>
		</div>
	</div>


	@includeIf('app.components.errors')


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Image Used in Wizards
				</div>


				<div class="card-body">
					@if ( $option->hasMedia('wizard_image'))
						<img src="{{ $option->getFirstMedia('wizard_image')->cdnUrl() }}"
							 style="width:100%;"
							 alt="">

						@endif


					<form enctype="multipart/form-data"
						  method="POST"
						  class="form-inline"
						  action="{{ route('option.wizard_image.set', [$option])  }}">

						{{ csrf_field() }}

								<input
										max="1024"
										name="upload"
										type="file"
										class="form-control" >

								<input type="submit" class="btn btn-dark" value="Upload Image">
					</form>


				</div>
			</div>
		</div>
	</div>
	<br>

@endsection
