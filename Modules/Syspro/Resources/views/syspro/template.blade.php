<!doctype html>
<html lang="en">
	<head>
		<title>Syspro</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />--}}
{{--		<meta http-equiv="Pragma" content="no-cache" />--}}
{{--		<meta http-equiv="Expires" content="0" />--}}

		<style type="text/css">
			html {
				background-color: rgb( 128, 167, 219 );
				/*padding: 0px 10px 0 10px;*/
				margin: 0;

			}
			body {
				padding:0;
				margin:0;
			}


			.syspro-menu
			{
				background: linear-gradient(0deg, rgb(231, 239, 248) 0%, rgb(212, 226, 242) 50%, rgb(231, 239, 248) 100%);
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
				background: linear-gradient(0deg, rgb(177, 211, 255) 0%, rgb(218, 233, 255) 100%);
				padding: 4px;
				border-bottom: 1px solid gray;
			}

			.syspro-button-yellow
			{
				background: linear-gradient(0deg, rgb(255, 239, 159) 0%, rgb(255, 250, 207) 100%);
				padding: 4px;
				border: 1px solid gray;
				color:black;
			}
			.syspro-button-yellow:hover
			{
				background: linear-gradient(0deg,  0%, rgb(209, 205, 170) 100%);
				padding: 4px;
				border: 1px solid gray;
				color:black;
			}

			.search-highlight
			{
				background-color: rgb(215, 201, 133);
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
				background-color: #8999ab;
			}
			.results-table th
			{
				text-align: left;
			}


		</style>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@yield('stylesheet')

	</head>
	<body>

		@yield('content')
		@yield('scripts')

	</body>
</html>
