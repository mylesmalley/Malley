<!doctype html>
<html lang="en">
  <head>
    <title>Malley Option Index</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ mix('css/homepage.css') }}" >

    <meta name="csrf-token" content="{{ csrf_token() }}">

      @includeIf('homepage::googleAnalytics')
    @livewireStyles

      @yield('stylesheet')

  </head>
  <body>


@includeIf('homepage::malleyMenu')

  <br />





    <h4 class="text-secondary text-center">Malley Option Index</h4>


  		<div class='container'>

   			@yield('content')

		</div>

@livewireScripts


        <script src="{{ mix('js/homepage.js') }}"></script>
        <script src="{{ mix('js/index.js') }}"></script>




    <script>
      @yield('javascript')
    </script>
  @yield('scripts')

  </body>
</html>
