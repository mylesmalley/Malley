@extends('bugreport::template')

@section('content')


	<div class="panel-body">
		<p>Your bug report or feedback has been submitted. Thank you for your help in improving Blueprint. We will let you know when this has been resolved.</p>

{{--		<ul>--}}
{{--			@if ( isset( $url ) )--}}
{{--				<li>--}}
{{--					<a href="{{ base64_decode( $url ) }}">Go back to where I was.</a>--}}
{{--				</li>--}}
{{--			@endif--}}
{{--			<li>--}}
{{--				<a href="/myblueprints">Visit My Blueprints.</a>--}}
{{--			</li>--}}
{{--			<li>--}}
{{--				<a href="/q">Create a new Blueprint.</a>--}}
{{--			</li>--}}
{{--		</ul>--}}
	</div>
@endsection
