<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Demo</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

       {{-- Laravel Mix - CSS File --}}
        <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">


        <style>
            svg.railroad-diagram {
                background-color: hsl(30,20%,95%);
            }
            svg.railroad-diagram path {
                stroke-width: 3;
                stroke: black;
                fill: rgba(0,0,0,0);
            }
            svg.railroad-diagram text {
                font: bold 14px monospace;
                text-anchor: middle;
                white-space: pre;
            }
            svg.railroad-diagram text.diagram-text {
                font-size: 12px;
            }
            svg.railroad-diagram text.diagram-arrow {
                font-size: 16px;
            }
            svg.railroad-diagram text.label {
                text-anchor: start;
            }
            svg.railroad-diagram text.comment {
                font: italic 12px monospace;
            }
            svg.railroad-diagram g.non-terminal text {
                /*font-style: italic;*/
            }
            svg.railroad-diagram rect {
                stroke-width: 3;
                stroke: black;
                fill: hsl(120,100%,90%);
            }
            svg.railroad-diagram rect.group-box {
                stroke: gray;
                stroke-dasharray: 10 5;
                fill: none;
            }
            svg.railroad-diagram path.diagram-text {
                stroke-width: 3;
                stroke: black;
                fill: white;
                cursor: help;
            }
            svg.railroad-diagram g.diagram-text:hover path.diagram-text {
                fill: #eee;
            }
        </style>
    </head>

    <body>

        @yield('content')
        @inertia

        <br>
        <br><br><br><br>
        <br>
        <br><br><br><br>
        {{-- Laravel Mix - JS File --}}
         <script src="{{ mix('js/demo.js') }}"></script>
    </body>
</html>
