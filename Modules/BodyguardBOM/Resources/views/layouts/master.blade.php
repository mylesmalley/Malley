<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bodyguard Components</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/homepage.css') }}">

    @includeIf('homepage::googleAnalytics')
    @livewireStyles

    @yield('stylesheet')

</head>
<body>


@includeIf('homepage::malleyMenu')
<br>
<h4 class="text-secondary text-center">Bodyguard BOM</h4>

<div class="container ">
    @yield('content')

</div>



@livewireScripts

@stack('scripts')
{{-- Laravel Mix - JS File --}}
<script src="{{ mix('js/homepage.js') }}"></script>
</body>
</html>

