<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ mix('css/announcement/announcement.css') }}">

    <title>Announcements</title>
</head>
<body>

<div class="container">
    <div class="child display-1 text-center">

        {{ $announcement->content ?? "Nothing to say?" }}
    </div>

</div>




{{--<script src="{{ mix('js/announcement.js') }}"></script>--}}
<script>
    window.setTimeout(function () {
        window.location.href = `{{ route('announcement.random') }}`
    }, 15000);
</script>


</body>

</html>
