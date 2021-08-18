@extends('index::app.main')

@section('stylesheet')
	<style>
		.floating-menu {
			position: fixed;
			left: 0;
			top: 30%;
			width: 10em;
			border: 1px solid #1b1e21;
			background: #b1b7ba;
			margin-top: -2.5em;
			padding:4px;
		}
		.floating-menu ul
		{
			list-style:none;
			padding-left:0px;
		}
		.floating-menu ul li:hover {
			background-color: orange;
		}
		.floating-menu a
		{
			width:100%;
			display: block;
		}
	</style>
@endsection

@section("content")
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/index/basevan">Platforms</a></li>
			<li class="breadcrumb-item active">{{ $baseVan->name }}</li>
		</ol>

	</nav>
	<h1>{{ $baseVan->name }}</h1>

	@includeIf('index::app.components.tabs', ['platform' => $baseVan, 'selected' => 'options'] )


	<h2> Options

		@optionEditor
			<a href="{{ url('/index/option/'.$baseVan->id.'/create') }}" class='btn btn-success float-right'>Create</a>
		@endoptionEditor
	</h2>


	<div class="floating-menu">
		<ul id="category-menu">

		</ul>
	</div>

	<table class='table table-hover table-striped'>
		<thead class="thead-dark">
			<tr>
				<th>#</th>
				<th>Description
				</th>
				<th>Components</th>
				@if (Auth::user()->show_image_count_in_index)
					<th>Images</th>
				@endif
				@if (Auth::user()->show_option_pricing_in_index)
					<th>MSRP</th>
				@endif
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($options as $option)
				<tr
					data-category="{{ substr( $option->option_name, 4, 1) }}"
					class="{{ $option->sysproComponents() == $option->indexComponents() ? "" : "table-danger" }}">


					<td onclick="window.location = '/option/{{ $option->id }}'">
						{{ $option->option_name }}
					</td>
						<td 	onclick="window.location = '/option/{{ $option->id }}'">
							{{ $option->option_description }}
							@if( $option->obsolete  )
								<b><u>OBSOLETE</u></b>
{{--								<b><u>x{{ $option->obsolete }}</u></b>--}}
							@endif
						</td>

						<td>{{ $option->components->count() }}</td>

						@if (Auth::user()->show_image_count_in_index)
							<td>{{ $option->media->count() }}</td>
						@endif

						@if (Auth::user()->show_option_pricing_in_index)
							<td>${{ number_format( $option->option_price_tier_3, 0) }}</td>
						@endif
					<td align="right">
						<div class="btn-group">
							<button class="btn btn-primary btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Actions
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="/index/option/{{ $option->id }}">Details</a>
								{{--<a class="dropdown-item" href="/index/option/{{ $option->id }}/edit">Edit Option Details</a>--}}
								<a class="dropdown-item" href="/index/option/{{ $option->id }}/compare">Compare To Syspro</a>
								<a class="dropdown-item" href="/index/option/{{ $option->id }}/drawings">Blueprint Drawings</a>
{{--								<a class="dropdown-item" href="/jira/option/{{ $option->id }}/create">Create JIRA Issue</a>--}}
							</div>
						</div>




				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('scripts')
	<script>
		/**
		 * scrolls the page to the first matching dom node
		 * @param category
		 */
		function jump( category )
		{
			let first = document.querySelector("[data-category='"+category+"']");
			first.scrollIntoView();
		}

		// defaults to empty {} object in the db
		let categories = {!! $baseVan->categories !!}
		let categoriesMenu = document.getElementById('category-menu');

		for (let cat in categories)
		{
			// create a wrapper li to simplify styling
			let wrapli = document.createElement('li');
			let link = document.createElement('a');

			// set the text of the link
			link.innerHTML = cat + " - " + categories[cat];

			// when the link is clicked, jump()
			link.addEventListener('click', function(){
				jump(cat);
			});

			wrapli.appendChild(link);
			categoriesMenu.appendChild(wrapli);
		}

	</script>
@endsection
