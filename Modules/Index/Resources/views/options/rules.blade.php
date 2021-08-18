@extends('index::app.main')



@section("content")
	<form method="POST" action="/index/option/{{ $option->id }}/rules">
		<div class="floating-menu">
			<ul id="category-menu">

			</ul>
		</div>

		<div style="position: sticky; top:0; background-color:white; border-bottom:2px solid black;">

		<h1>Rules for {{ $option->option_name }}
			<input type="submit" class="btn btn-primary btn-lg float-right" /></h1>
		<h3> {{ $option->option_description }}
			</h3>
	</div>

		{{ csrf_field() }}

		<table id="options_table" class="table table-striped table-condensed">
			<thead class="bg-dark text-white" >
			<tr>
				<th>Related Option</th>
				<th>Rule</th>
				<th></th>
				<th></th>
				<th>Rule</th>
				<th>Related Option</th>

			</tr>
			</thead>
			<tbody>
				@foreach( $options as $opt )
					<tr data-category="{{ substr( $opt->option_name, 4, 1) }}">
						<td class="{{ array_key_exists( $opt->id, $currentOptions ) ? $rowClasses[$currentOptions[$opt->id]] : '' }}">

							{{ $opt->option_name }}<br />{{ $opt->option_description }}
						</td>
						<td class="{{ array_key_exists( $opt->id, $currentOptions ) ? $rowClasses[$currentOptions[$opt->id]] : '' }}">
							<select class="form-control form-control-sm" name="option[{{ $opt->id }}]">
								@foreach( \App\Models\OptionRule::ruleTypes() as $k => $v)
									<option
										value="{{ $k }}"
										@if ( array_key_exists( $opt->id, $currentOptions ) && $currentOptions[$opt->id] == $k)
											selected
											@endif
									>
										{{ $v }}
									</option>
								@endforeach

							</select>

						</td>
						<td style="border-right:4px solid black;">
							with THIS</td>
						<td>THIS</td>
						<td class="{{ array_key_exists( $opt->id, $inverse ) ? $rowClasses[ $inverse[$opt->id]->rule_type] : '' }}">
							<select class="form-control form-control-sm" name="inverse[{{ $opt->id }}]">
								@foreach( \App\Models\OptionRule::ruleTypes() as $k => $v)
									<option
											value="{{ $k }}"
											@if ( array_key_exists( $opt->id, $inverse ) && $inverse[$opt->id]->rule_type == $k)
											selected
											@endif
									>
										{{ $v }}
									</option>
								@endforeach

							</select>

						</td>
						<td class="{{ array_key_exists( $opt->id, $inverse ) ? $rowClasses[ $inverse[$opt->id]->rule_type] : '' }}">
						with {{ $opt->option_name }}<br />{{ $opt->option_description }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<input type="submit" class="btn btn-primary btn-lg" />
	</form>
@endsection




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

@section('scripts')
	<script>
		/**
		 * scrolls the page to the first matching dom node
		 * @param category
		 */
		function jump( category )
		{
			let first = document.querySelector("[data-category='"+category+"']");
			first.scrollIntoView(  );
			window.scrollBy(0,-100);
		}

		// defaults to empty {} object in the db
		let categories = {!! $option->platform->categories !!}
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
