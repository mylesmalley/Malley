@extends('syspro::template')

@section("content")

	<h1>MDEL Assignment Report</h1>

	@includeIf('app.components.errors')

    <div class="container">
        <div class="form-row">
            <div class="form-group col-3">

                <label for="col">Sort Column</label>
                <select id="col" name="col" class="form-control">
                    <option value="Job">Job</option>
                    <option value="JobDescription">Description</option>
                    <option value="status">Status</option>
                    <option value="JobTenderDate">Tender Date</option>
                    <option value="JobClassification">Type</option>
                    <option value="MDEL">Chassis</option>
                </select>
            </div>
            <div class="form-group col-3">

                <label for="sort">Direction</label>
                <select name="sort" id="sort" class="form-control">
                    <option value="ASC">Ascending</option>
                    <option value="DESC">Descending</option>
                </select>
            </div>
            <div class="form-group col-3">

                <label for="year">Year</label>
                <select name="year" id="year" class="form-control">
                    @for ( $i = date('Y'); $i > date('Y') -5; $i--)
                        <option>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-2">
                <a href="#" onclick="go();" class="btn btn-xl btn-success">GO</a>

            </div>
        </div>
    </div>


	<table class="table table-hover table-condensed table-striped">
		<thead>
			<tr>
				<th>Job</th>
				<th>Description</th>
				<th>Customer</th>
				<th>Status</th>
				<th>Tender Date</th>
				<th>Type</th>
				<th>Chassis</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $results as $row )
				<tr>
					<td>{{ $row->Job }}</td>
					<td>{{ $row->JobDescription }}</td>
					<td>{{ $row->CustomerName }}</td>
					<td>
						@if ( $row->Complete === "Y")
							Closed
						@else
							{{ $row->status === 'Y' ? "Started" : "Planned" }}
						@endif
					</td>
					<td>{{ substr( $row->JobTenderDate, 0, 10) }}</td>
					<td>{{ $row->JobClassification }}</td>
					<td>{{ $row->MDEL }}<br />{{ $row->VehicleType }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection

@section('scripts')
    <script>
        function get(name){
            if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
                return decodeURIComponent(name[1]);
        }
        window.onload = function() {

            let col = document.getElementById('col');
            let year = document.getElementById('year');
            let sort = document.getElementById('sort');

            if ( get('col'))
            {
                col.value = get('col');
            }
            if ( get('sort'))
            {
                sort.value = get('sort');
            }
            if ( get('year'))
            {
                year.value = get('year');
            }

            yourFunction(param1, param2);
        };



        function go()
        {

            let c = document.getElementById('col');
            let col = c.options[c.selectedIndex].value;

            let s = document.getElementById('sort');
            let sort = s.options[s.selectedIndex].value;


            let y = document.getElementById('year');
            let year = y.options[y.selectedIndex].text;

            window.location.href = `{{ url('/syspro/MDELReport') }}?col=${col}&year=${year}&sort=${sort}`;

         //   alert(`${col} ${sort} ${year}`);
        }
    </script>
    @endsection
