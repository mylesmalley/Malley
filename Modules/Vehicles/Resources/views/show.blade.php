@extends('vehicles::layout')

@section('content')



        <div class="row">
            <div class="col-12 text-center">
                <h1> {{ $vehicle->identifier }}</h1>
            </div>
        </div>
        <h2 class="text-center text-secondary">{{ $vehicle->year ?? '' }} {{ ucfirst( strtolower( $vehicle->make ) ) ?? "" }} {{ ucfirst( $vehicle->model ) ?? "" }}</h2>

        <br>
        @if( $vehicle->id !== 3086)

        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="First group">
                @if ( $vehicle->work_order )
                    @if ($vehicle->prev)
                        <a href="{{ url('vehicles/'.$vehicle->prev ) }}" class="btn btn-secondary btn-sm">&lt; Previous</a> &nbsp;
                    @endif
                    @if ($vehicle->next)
                        <a href="{{ url('vehicles/'.$vehicle->next ) }}" class="btn btn-secondary btn-sm">Next &gt;</a>
                    @endif
                @endif
            </div>
        </div>
        @else
            <div class="card bg-info text-white">
                <div class="card-body">
                    <p>This is a special page on the Vehicle Database that allows you to create blank documents for whne you do not know the vehicle something is needed for.</p>
                </div>
            </div>

        @endif


{{--            <div class="input-group">--}}
{{--                --}}{{--            <a href="" class="btn btn-secondary btn-lg">Settings</a> &nbsp;--}}
{{--                <a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-sm">Back To Index</a>--}}
{{--            </div>--}}





{{--        @if ( $vehicle->work_order )--}}
{{--            <div class="row">--}}
{{--                <a class="btn btn-secondary" href="{{ url('vehicles/'.$vehicle->prev ) }}">Prev</a>--}}
{{--                <a class="btn btn-secondary" href="{{ url('vehicles/'.$vehicle->next ) }}">Next</a>--}}
{{--            </div>--}}
{{--        @endif--}}
    <br>

        @if( $vehicle->id !== 3086)

            @include('vehicles::sections.about')
                <br>
            @include('vehicles::sections.warranty')

            @include('vehicles::sections.albums')
        @endif

    <br>
        @if( $vehicle->id !== 3086)

            <div class="row">
                <div class="col-md-6">
                    @include('vehicles::sections.files')

                </div>
                <div class="col-md-6">
                    @include('vehicles::sections.dates')
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    @include('vehicles::sections.serials')
                </div>

            </div>
        @endif

        @if( $vehicle->id !== 3086)

    <br />
       @includeIf('vehicles::sections.warrantyClaims')

    <br>

            @includeIf('vehicles::sections.inspections')
    @endif

    @include('vehicles::sections.work_orders')





    {{--    --}}
{{--    <div class='row'>--}}
{{--        <div class='col-md-12'>--}}
{{--            <h2>Contacts<a href="{{ url('contacts/vehicle/'.$vehicle->id ) }}" class='btn btn-primary float-right'>Edit</a></h2>--}}
{{--            --}}
{{--            <table class='table table-striped table-hover'>--}}
{{--                <thead class='thead-inverse'>--}}
{{--                <tr>--}}
{{--                    <th>Role</th>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Information</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach( $vehicle->contacts as $contact )--}}
{{--                    <tr onclick="window.location = '{{ url('/contacts/'.$contact->id) }}'; ">--}}
{{--                        <td>{{ $contact->contact_type }}</td>--}}
{{--                        <td>{{ $contact->name }}</td>--}}
{{--                        <td> </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div id='calendar'></div>--}}

@endsection


{{--@section('calendarScript')--}}
{{--    <link href='{{ url('shared/fullcalendar/list/main.css') }}' rel='stylesheet' />--}}
{{--    <script src='{{ url('shared/fullcalendar/list/main.js') }}'></script>--}}

{{--    <script>--}}

{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            const calendarEl = document.getElementById('calendar');--}}

{{--            let calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--                plugins: [ 'list' ],--}}
{{--                defaultView: "list",--}}
{{--                duration: { days: 365 },--}}

{{--                customButtons: {--}}
{{--                    newDateButton: {--}}
{{--                        text: 'Add New',--}}
{{--                        click: function() {--}}
{{--                            window.location = `{{ url("/vehicles/{$vehicle->id}/date") }}`;--}}
{{--                        }--}}
{{--                    }--}}
{{--                },--}}
{{--                header: {--}}
{{--                    right: 'prev,next today newDateButton',--}}
{{--                    center: 'title',--}}
{{--                    left: ''--}}
{{--                },--}}



{{--                eventSources: [--}}

{{--                    // your event source--}}
{{--                    {--}}
{{--                        url: '/vehicles/{{ $vehicle->id }}/dates',--}}
{{--                        method: 'POST',--}}
{{--                        extraParams: {--}}
{{--                            _token: "{{ csrf_token() }}",--}}
{{--                            custom_param2: 'somethingelse'--}}
{{--                        },--}}
{{--                        failure: function() {--}}
{{--                            alert('there was an error while fetching events!');--}}
{{--                        },--}}
{{--               //         color: 'yellow',   // a non-ajax option--}}
{{--             //           textColor: 'black' // a non-ajax option--}}
{{--                    }--}}
{{--                ],--}}
{{--                eventClick: function( info ){--}}
{{--                    window.location = `{{ url("/vehicles/dates") }}/${info.event.id}`;--}}
{{--                }--}}
{{--            });--}}

{{--            calendar.render();--}}
{{--        });--}}

{{--    </script>--}}
{{--@endsection--}}
