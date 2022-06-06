<!doctype html>
<html lang="en">
<head>
	<title>Syspro</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ mix('css/homepage.css') }}" >

	<meta name="csrf-token" content="{{ csrf_token() }}">

	<style>
			.wrapper {
				background-color: rgb(85, 85, 85) !important;
			}



					.syspro-menu
					{
						background: linear-gradient(0deg, rgb(241, 241, 241) 0%, rgb(214, 214, 214) 50%, rgb(241, 241, 241) 100%);
						padding: 4px;
						border: 1px solid gray;
					}


					.syspro-window
					{
						background-color: white;
						color:black;
						border: 1px solid gray;
					}

					.syspro-window-menu
					{
						background: linear-gradient(0deg, rgb(210, 210, 210) 0%, rgb(247, 247, 247) 100%);
						padding: 4px;
						border-bottom: 1px solid gray;
					}

					.syspro-button-yellow
					{
						background: linear-gradient(0deg, rgb(255, 188, 159) 0%, rgb(255, 220, 207) 100%);
						padding: 4px;
						border: 1px solid gray;
						color:black;
					}
					.syspro-button-yellow:hover
					{
						background: linear-gradient(0deg,  0%, rgb(209, 180, 170) 100%);
						padding: 4px;
						border: 1px solid gray;
						color:black;
					}

					.search-highlight
					{
						background-color: rgb(215, 163, 133);
					}

					.syspro-window-content
					{
						color:black;
						padding: 4px;
					}

					.syspro-window-content tr td:first-child
					{
						font-weight: bold;
					}


					.results-table
					{
						width: 100%;
						border-spacing: 0px;
						border-collapse: separate;
					}
					.results-table tr
					{
						border-bottom: 1px solid #999;
					}
					.results-table tbody tr:hover
					{
						background-color: #bdbdbd;
					}
					.results-table th
					{
						text-align: left;
					}
	</style>


@includeIf('homepage::googleAnalytics')
@livewireStyles

@yield('stylesheet')

<!-- Header Script Stack -->
@stack('header_scripts')
<!-- END Header Script Stack -->


</head>
<body>

@includeIf('homepage::malleyMenu')

@if ($errors->any() )
	<div class="row">
		<div class="col-6 offset-3">
			<div class="card border-danger text-white bg-danger">
				<div class="card-header">
					Ran into some issues...
				</div>
				<div class="card-body">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
@endif


@if( session('success') )
	<div class="row">
		<div class="col-6 offset-3">
			<div class="card border-success text-white bg-success">
				<div class="card-header">
					<strong>Success</strong> :  {{ session('success') }}
				</div>
			</div>
		</div>
	</div>
@endif

<div class="wrapper">


	@yield('content')
</div>


<script src="{{ mix('js/homepage.js') }}"></script>

@livewireScripts

@stack('scripts')
<script>

</script>
</body>
</html>







{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--	<head>--}}
{{--		<title>Syspro</title>--}}
{{--		<!-- Required meta tags -->--}}
{{--		<meta charset="utf-8">--}}
{{--		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />--}}
{{--		<meta http-equiv="Pragma" content="no-cache" />--}}
{{--		<meta http-equiv="Expires" content="0" />--}}
{{--		<link rel="stylesheet" href="{{ mix("css/homepage.css") }}" >--}}



{{--		</style>--}}
{{--		<meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--		@yield('stylesheet')--}}

{{--	</head>--}}
{{--	<body>--}}
{{--		@includeIf('homepage::malleyMenu')--}}
{{--		@yield('content')--}}
{{--		@yield('scripts')--}}
{{--		<script src="{{ mix("js/homepage.js") }}" ></script>--}}

{{--	</body>--}}
{{--</html>--}}
