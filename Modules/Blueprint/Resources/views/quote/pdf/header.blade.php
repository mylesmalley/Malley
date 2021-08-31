<table style="width:100%;">
	<tr>
		<td>
			<h1>Quotation</h1>
			<h3>{{ $blueprint->quote_number ?? "" }} for B-{{ $blueprint->id }}</h3>
			
			<p> <b>"{{ $blueprint->name }}"</b></p>
			<p> {{ $blueprint->description }}</p>
			<p>Platform: {{ $blueprint->platform->name }}</p>
		</td>
		<td style="text-align:right; vertical-align: top;">
			<img src="data:image/png;base64,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"
			     style="width:200px;"
			     alt="logo"><span style="color:rgb(47, 44, 117); font-size:9pt;">
			Malley Industries Inc. <br />
			1100 Aviation Avenue<br />
			Dieppe, NB, E1A 9A3<br />
			www.malleyindustries.com
			</span>
		</td>
	</tr>
</table>
<br>
<table id="infoTable">
	<thead>
		<tr>
			<th >
				<h3>Dealer</h3>
			</th>
			<th >
				<h3>Customer</h3>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>{{ $dealer->name }}</strong><br />
				{!! $dealer->address_1 ? $dealer->address_1."<br>" : ''   !!}
				{!! $dealer->address_2 ? $dealer->address_2."<br>" : ''   !!}
				{!! $dealer->address_3 ? $dealer->address_3."<br>" : ''   !!}
				{!! $dealer->city ?? '' !!}
				{!! $dealer->province ?? '' !!}
				{!! $dealer->country ?? '' !!}
				{!! $dealer->postalcode ?? '' !!}
			</td>
			<td>
				<strong>{{ $blueprint->customer_name ?? "Not provided"}}</strong><br />
				{!! $blueprint->customer_address_1 ? $blueprint->customer_address_1."<br>" : ''   !!}
				{!! $blueprint->customer_address_2 ? $blueprint->customer_address_2."<br>" : ''   !!}
				{!! $blueprint->customer_address_3 ? $blueprint->customer_address_3."<br>" : ''   !!}
				{!! $blueprint->customer_city ?? '' !!}
				{!! $blueprint->customer_province ?? '' !!}
				{!! $blueprint->customer_country ?? '' !!}
				{!! $blueprint->customer_postalcode ?? '' !!}
			</td>
		</tr>
	</tbody>
</table>
