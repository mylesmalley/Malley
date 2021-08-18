<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ public_path('css/announcement.css') }}">

        <title>Announcements</title>
    </head>
    <body>

    <div class="container">
        <div class="child display-1 text-center">
            @yield('content')
        </div>
    </div>




        <script src="{{ public_path('js/announcement.js') }}"></script>



    </body>
</html>
