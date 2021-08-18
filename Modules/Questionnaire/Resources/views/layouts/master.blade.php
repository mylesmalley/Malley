<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Questionnaire</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

       {{-- Laravel Mix - CSS File --}}
        @livewireStyles

        <link rel="stylesheet" href="{{ mix('css/homepage.css') }}">

    </head>
    <body>
        @yield('content')

        {{-- Laravel Mix - JS File --}}
        @livewireScripts

        <script src="{{ mix('js/homepage.js') }}"></script>
        <script src="{{ mix('js/questionnaire.js') }}"></script>
    </body>
</html>
