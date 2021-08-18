@extends('vehicles::layout')
@php
    $php_format = "Y-m-d H:i:s.v";
    $js_format = 'YYYY-MM-DD hh:mm:ss.SSS';
@endphp
@section('content')
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-3">Edit a date for {{ $date->vehicle->identifier }}</h1>
        </div>
    </div>

    @includeIf('vehicles::errors')
    <form class="form" method="POST" action="{{ url("/vehicles/dates/{$date->id}") }}">
        {{ csrf_field() }}
    <table class="table">
        <tbody>
        <tr>
            <td><label for="title">Type</label></td>
            <td>
                <select name="title" id="title" class="form-control-lg">
                    @foreach(\App\Models\VehicleDate::getCalendarDates() as $title)
                        <option value="{{ urlencode($title) }}"
                            {{ urlencode($title) === $date->title ? 'selected' : '' }}
                        >{{ $title }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
            <tr>
                <td><label for="start">Start</label></td>
                <td>
                    <input type="hidden"
                           name="start"
                           id="start"
                           value="{{ old('start')
                                    ?? $date->start
                                    ?? date( $php_format ) }}">
                    <div style="width:300px" id="datetimepicker13"></div>
                </td>
            </tr>

            <tr>
                <td><label for="notes">Notes</label></td>
                <td>
                    <textarea
                        style="height:auto;"
                        id="notes"
                        cols="50"
                        rows="10"
                        name="notes" class="form-control-lg">{{ old('notes') ?? $date->notes ?? "" }}</textarea>
                </td>
            </tr>
        </tbody>

    </table>
        <input type="submit" class="btn btn-primary btn-lg" value="Save Changes">
    </form>

    <script type="text/javascript">

            $(function () {
                $('#datetimepicker13').datetimepicker({
                    inline: true,
                    format: "{{ $js_format }}",
                    defaultDate: "{{ $date->start }}",
                });
                $('#datetimepicker13').on("change.datetimepicker", function (e) {
                    console.log(e.date.format("{{ $js_format }}"));
                    document.getElementById('start').value = e.date.format("{{ $js_format }}");
                });
                $('#datetimepicker13').on("show.datetimepicker", function (e) {
                    console.log(e.date.format("{{ $js_format }}"));

                    document.getElementById('start').value = e.date.format("{{ $js_format }}");
                });
            });
        </script>
    @endsection
