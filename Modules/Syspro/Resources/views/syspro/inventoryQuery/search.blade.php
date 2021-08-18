@extends('syspro::syspro.template')

@section('stylesheet')

	<style>


		#results
		{
			grid-area: results;
		}

		#top-menu
		{
			grid-area: top-menu;

		}

		.container {
			height: 100vh;
			display: grid;
			grid-template-columns: 100%;
			grid-template-rows: 30px  auto;
			grid-template-areas:
					"top-menu "
					"results";
			grid-column-gap: 10px;
			grid-row-gap: 10px;
		}
	</style>
@endsection

@section("content")
	<div class="container">

		<div id="top-menu" class="syspro-menu">

			<form method="post" action="{{ url("/syspro/inventoryQuery/search" ) }}">
				{{ csrf_field() }}

				SEARCH<input type="text" value="{{ $term }}" name="term" />
				<input type="submit" value="GO">

			</form>
		</div>


		<div id="results" class="syspro-window ">
			<div class="syspro-window-menu">Search Results</div>
			<div class="syspro-window-content">

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@else
					<table class="results-table">
						<thead>
							<tr>
								<th>Stock Code</th>
								<th>Description</th>
								<th>Long Description</th>
                                <th>Supplier Stock Code</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $results as $res)
								<tr class="inventory-row" data-stockcode="{{ $res['Code'] }}">
									<td>{!! $res['StockCode'] !!}</td>
									<td>{!! $res['Description'] !!}</td>
									<td>{!! $res['LongDesc'] !!}</td>
                                    <td>{!! $res['SupCatalogueNum'] !!}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
		</div>


	</div>
@endsection

@section('scripts')
	<script>
		let rows = document.getElementsByClassName('inventory-row');

		for ( let i = 0; i < rows.length; i++ )
		{
			rows[i].addEventListener('click', function(){
				let code = rows[i].dataset.stockcode ;
				window.location.href = `/syspro/inventoryQuery/${code}`;
			});
		}
	</script>
@endsection
