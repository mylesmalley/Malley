<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Malley Vehicle Database</title>


{{--    <script src='{{ url('shared/js/bootstrap.min.js') }}'></script>--}}
{{--    <script src='{{ url('shared/js/popper.min.js') }}'></script>--}}

    <!-- Bootstrap core CSS -->
{{--    <link href="{{ url('shared/css/bootstrap.min.css') }}" rel="stylesheet">--}}
{{--    <script src='{{ url('shared/fullcalendar/bootstrap/main.js') }}'></script>--}}

    <!-- FULL CALENDAR CORE  -->
{{--    <link href='{{ url('shared/fullcalendar/core/main.css') }}' rel='stylesheet' />--}}
{{--    <script src='{{ url('shared/fullcalendar/core/main.js') }}'></script>--}}
    <link href='{{ mix('css/homepage.css') }}' rel='stylesheet'>

{{--    <link href='{{ url('shared/datepicker/datepicker.css') }}' rel='stylesheet'></link>--}}

    @yield('headerScripts')

    @yield('calendarScript')
    @yield('stylesheet')

   @includeIf('homepage::googleAnalytics')
</head>

<body>



@includeIf('homepage::malleyMenu')
<br>
<h4 class="text-secondary text-center">Vehicle Database</h4>

<!-- Page Content -->
<div class="container">

    @yield('content')

    <br><br>
</div>


{{--<script src='{{ mix('js/homepage.js') }}'></script>--}}
{{--<script src='{{ url('shared/js/jquery.min.js') }}'></script>--}}
{{--<script src='{{ url('shared/js/moment.js') }}'></script>--}}
{{--<script src='{{ url('shared/datepicker/datepicker.js') }}'></script>--}}


@yield('scripts')
@stack('script_stack')

</body>
<script src="{{ mix('js/homepage.js') }}"></script>

</html>
