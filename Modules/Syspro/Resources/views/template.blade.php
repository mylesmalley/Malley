<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Purchase Requests</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('shared/css/bootstrap.min.css') }}" rel="stylesheet">
    @yield('stylesheet')


    <style>
        @media print {
            .form-wrapper {
                display:none;
            }
        }
    </style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success static-top">
    <div class="container">
        <img src="data:image/png;base64,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"
             style="height:30px;"
             alt="">

    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @yield('content')

</div>

<script src='{{ url('shared/js/jquery.min.js') }}'></script>
<script src='{{ url('shared/js/bootstrap.min.js') }}'></script>

@yield('scripts')

</body>

</html>
