@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">{{ urldecode( $title  )}} Calendar</h1>
        </div>
    </div>
    <div id='calendar'></div>

@endsection
@section('calendarScript')
    <link href='{{ url('shared/fullcalendar/list/main.css') }}' rel='stylesheet' />
    <script src='{{ url('shared/fullcalendar/list/main.js') }}'></script>

    <link href='{{ url('shared/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <script src='{{ url('shared/fullcalendar/daygrid/main.js') }}'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'list', 'dayGrid' ],
                defaultView: "list",
                duration: { months: 1 },
                header: {
                    left:   'title',
                        center: '',
                    right:  'dayGrid list today prev,next'
                },
                eventSources: [

                    // your event source
                    {
                        url: '/vehicles/calendar/{{ $title }}',
                        method: 'POST',
                        extraParams: {
                            _token: "{{ csrf_token() }}",
                            custom_param2: 'somethingelse'
                        },
                        failure: function() {
                            alert('there was an error while fetching events!');
                        },
                        //         color: 'yellow',   // a non-ajax option
                        //           textColor: 'black' // a non-ajax option
                    }
                ],
                eventClick: function( info ){
                    window.location = `{{ url("/vehicles/") }}/${info.event.extendedProps.vehicle_id}`;
                }
            });

            calendar.render();
        });

    </script>
@endsection
