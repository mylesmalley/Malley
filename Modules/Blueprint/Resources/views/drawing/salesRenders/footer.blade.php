<div class="footer">
	<table>
		<tr>
			<td></td>
			<td></td>
			<td>
				<h4>Dealer</h4>
			
			</td>
			<td></td>
			<td>
				@if ( $blueprint->customer_name )
				<h4>Prepared For</h4>
					@endif
			</td>
			<td>
			
			</td>
		</tr>
		<tr>
			<td>
{{--				Created by {{ Auth::user()->first_name }}<br />--}}
				<h4>Malley Industries</h4>
				1100 Aviation Avenue,<br/>
				Dieppe, NB, Canada, E1A 9A3<br>
				&copy; {{ date("Y") }}
				<BR />
				<h2>Page {PAGENO} of {nb}.</h2>
			</td>
			<td>
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				@if ( $image )
						<img style="max-width:200px; max-height:100px;" src="data:image/png;base64,{{ $image }}"  alt="">
					
				@endif
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
				&nbsp;
			</td>
			<td>
				<b>{{ $company->name }}</b><br>
				{!!  $company->address_1 ? $company->address_1.'<br />' : '' !!}
				{!! $company->address_2 ? $company->address_2.'<br />' : '' !!}
				{!! $company->city ? $company->city.', ' : '' !!} {!! $company->province ? $company->province.', ' : '' !!} {!! $company->postalcode ? $company->postalcode : '' !!}<br />
				{!!  $company->phone ? $company->phone.'<br />' : '' !!}
				{!!  $company->fax ? $company->fax : '' !!}
			</td>
			<td>
				<br><br />

			</td>
			<td>
				@if ( $blueprint->customer_name )
					<h4>{{ $blueprint->customer_name }}</h4>
				{!!  $blueprint->customer_address_1 ? $blueprint->customer_address_1.'<br />' : '' !!}
				{!! $blueprint->customer_address_2 ? $blueprint->customer_address_2.'<br />' : '' !!}
				{!! $blueprint->customer_city ? $blueprint->customer_city.', ' : '' !!} {!! $blueprint->customer_province ? $blueprint->customer_province.', ' : '' !!} {!! $blueprint->customer_postalcode ? $blueprint->customer_postalcode : '' !!}
				@endif
			</td>
			<td>

			</td>
		</tr>
	</table>

	

	
	
{{--	@if ($blueprint->user->company->logo)--}}
{{--		<img alt="logo" width="200" src="{{ $blueprint->user->company->logo }}" />--}}
{{--	@endif--}}
</div>

