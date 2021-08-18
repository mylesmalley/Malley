@extends('index::app.main')

@section("content")
	<h1>Search For Components</h1>
	<div class="row alert alert-info">
		<div class='col-md-3'>
			Stock Code
			<input type="text" class="form-control" name="stockCode" value="" id="stockCode" />
		</div>
		<div class='col-md-3'>
			Platform
			<select class="form-control" id="base_van_id">
				<option value="all"> All Platforms </option>
				@foreach( \App\Models\BaseVan::all() as $baseVan )
					<option value="{{ $baseVan->id }}"> {{ $baseVan->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead class="thead-dark">
			<th>Stock Code</th>
			<th>Qty</th>
			<th>Option</th>
			<th>Description</th>
		</thead>
		<tbody id="results">

		</tbody>
	</table>
@endsection
@section('scripts')
	<script>
		function refreshResultsTable( data )
		{
			let results = document.getElementById('results');
			results.innerHTML = "";
			data.forEach(function( item ){
				//let url = "'" +"/options/"+item.option_id +"'";

				results.innerHTML += "<tr onclick='redirect("+item.option_id+");'>"
					+ "<td>" + item.component_stock_code + "</td>"
					+ "<td>" + item.component_material_qty + "</td>"
					+ "<td>" + item.option_name + "</td>"
					+ "<td>" + item.option_description + "</td>"
					+ "</tr>";
			});
		}

		function redirect( id )
		{
			window.location = "/index/option/"+id+"/home";
		}


		function send( searchTerm )
		{
			let xhr = new XMLHttpRequest();

			xhr.open("POST", "/search/components" );
			xhr.setRequestHeader('Content-Type', 'application/json');
			xhr.onload = function( response ) {
				//console.log( xhr.responseText );
				refreshResultsTable( JSON.parse( xhr.responseText ) );
			};
			xhr.send(JSON.stringify({
				"_token": "{{ csrf_token() }}",
				searchTerm: searchTerm,
				baseVanId: document.getElementById('base_van_id').value
			}));
		}



		let inputElement = document.getElementById('stockCode');

		function init()
		{

			@if ( request()->get('q')  )
				send( "{{ request()->get('q') }}" );
				inputElement.value = "{{ request()->get('q') }}";
			@else

				if (inputElement.value.length >= 3)
				{
					send( inputElement.value );
				}
			@endif

			inputElement.addEventListener('blur',function(){
				if (this.value.length >= 3)
				{
					send( this.value );
				}
			});
			document.getElementById('base_van_id').addEventListener('change', function(){
				if (inputElement.value.length >= 3)
				{
					send( inputElement.value );
				}
			});
		}

		window.onload = init();


	</script>
	@endsection
