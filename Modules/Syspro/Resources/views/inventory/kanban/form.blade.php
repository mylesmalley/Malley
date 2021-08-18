@extends('index::app.main')

@section('content')

	<div class="panel-heading"><h1>
			New KANBAN Label
		</h1> </div>

	@includeIf('app.components.errors')

	<div class="panel-body">
		<form action="{{ url('/inventory/kanban/form') }}" method="POST">
			{{ csrf_field() }}

			<div class="row">
				<div class="col-md-5">
					<label for="find">Lookup Stock Code</label>
					<input type="text"
					       name="find"
					       id="find"
					       class="form-control"
					       placeholder="e.g. 15-13200">
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<label for="StockCode">StockCode</label>
					<input type="text"
					       name="StockCode"
					       id="StockCode"
					       class="form-control"
					       placeholder="15-13200">
				</div>
			</div>


			<div class="row">
				<div class="col-md-5">
					<label for="GroupID">GroupID</label>
					<input type="text"
					       name="GroupID"
					       id="GroupID"
					       class="form-control"
					       placeholder="WM">
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<label for="DefaultBin">Bin</label>
					<input type="text"
					       name="DefaultBin"
					       id="DefaultBin"
					       class="form-control"
					       placeholder="A4">
				</div>
			</div>

			<div class="row">
				<div class="col-md-5">
					<label for="Description">Description</label>
					<input type="text"
					       name="Description"
					       id="Description"
					       class="form-control"
					       placeholder="Description">
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<input type="submit" class="btn btn-primary">
				</div>
			</div>

		</form>
	</div>
@endsection

@section('scripts')
	<script>

	$(function(){
		$( "#find" ).autocomplete({
			source: "{{ url('syspro/search') }}",
			minLength: 3,
			delay: 500,
			focus: function( event, ui ) {
			$( "#find" ).val( ui.item.StockCode.trim() );
				return false;
			},
			select: function( event, ui ) {
				$('#StockCode').empty().val( ui.item.StockCode );
				$('#Description').empty().val( ui.item.Description );

			}
		}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" )
			.append( "<div>" + item.StockCode + "<br>" + item.Description + "</div>" )
			.appendTo( ul );
			};

	});
	</script>


@endsection
