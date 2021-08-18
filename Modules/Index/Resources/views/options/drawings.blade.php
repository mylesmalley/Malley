@extends('index::app.main')


@section("content")


	<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group" role="group" aria-label="First group">
			@if ( !$option->obsolete )
				@if ($option->previousID)
					<a href="/index/option/{{ $option->previousId }}/drawings" class="btn btn-secondary btn-lg">&lt; Previous</a> &nbsp;
				@endif
				@if ($option->nextID)
					<a href="/index/option/{{ $option->nextID }}/drawings" class="btn btn-secondary btn-lg">Next &gt;</a>
				@endif
			@endif
		</div>
		<div class="input-group">
			<a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
		</div>

		<div class="input-group">
			<a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>
		</div>

	</div>

	<div class="row">
		<div class="col-12">
			<h1>{{ $option->fullName }} Drawings</h1>
			<h3 class="text-secondary">{{ $option->option_description }}</h3>
		</div>
	</div>


	@includeIf('app.components.errors')


	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Add New Drawings
				</div>


				<div class="card-body">
					<form enctype="multipart/form-data"
						  method="POST"
						  class="form-inline"
						  action="{{ url("/index/option/{$option->id}/drawings") }}">


						{{ csrf_field() }}

						<input
								max="10000"
								name="upload[]"
								multiple
								type="file"
								class="form-control" >

						<input type="submit" class="btn btn-dark" value="Upload Drawing(s) ">
					</form>


				</div>
			</div>
		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					Drawings for this option
				</div>


				<table class="table table-striped">
					<tbody>




					@foreach($option->getMedia('drawings') as $photo)
						<tr>
							<td>
								<img style="border: 1px solid black;" width="400" src="{{ $photo->cdnUrl() }}" alt="{{ $photo->name }}" />
							</td>

							<td style="float:left; vertical-align: top">
								Media ID: {{ $photo->id }} <br>
								AWS Path: {{ $photo->getPath() }} <br>
								<br>

								<h4>Tags
									@if( !$option->obsolete )
										@if( Auth::user()->can_edit_options )

											<a href="{{ url('index/option/'.$option->id.'/drawings/'.$photo->id) }}"
											   class='btn btn-sm btn-outline-dark '>Edit Tags</a>
										@endif
									@endif</h4>



								@foreach( $photo->tags as $tag )
									<span class="badge badge-dark">{{ $tag->name }}</span>
								@endforeach

								<br>
								<br>



								<h4>Used on Forms</h4>
									@foreach( App\Models\FormElementItem::where('media_id', $photo->id )->with('formElement','formElement.form')->get() as $reference )
									<span class="badge badge-primary">{{ $reference->formElement->form->name }}</span>
										@endforeach


								<br>
								<br>
								@optionEditor
								@if (! $option->obsolete )
									<form action="{{ url( 'index/option/'.$option->id.'/drawings/'.$photo->id ) }}" method="POST">
										{{ method_field('DELETE') }}
										{{ csrf_field() }}
										<input type="submit" class="btn btn-danger btn-xl" value="Delete this Photo">
									</form>
								@endif
								@endoptionEditor



							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>


@endsection
