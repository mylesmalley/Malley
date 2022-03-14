<div class="card border-primary">
    <div class="card-header bg-primary text-white" >
        Dates

{{--        @if( Auth::user()->vdb_modify_photos )--}}
            <a href="{{ route('vehicle.dates', [$vehicle]) }}"
               class='btn btn-sm btn-secondary float-end'>Edit Dates</a>
{{--        @endif--}}
    </div>
    <table class="table table-striped table-sm detail-table">
        <thead>
            <tr>
                <th class="text-start">Event</th>
                <th class="text-start">Date</th>
                <th class="text-center">Notes</th>
                <th class="text-start">Location</th>
            </tr>
        </thead>
        <tbody>

        <tr>
            <td>
                Added to Database
            </td>
            <td>
                {{ \Carbon\Carbon::create($vehicle->created_at)->format('Y-m-d') }}
            </td>
            <td></td>
            <td></td>
        </tr>
        @foreach( $vehicle->dates as $date )
            <tr>
                <td>
                    {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                </td>
                <td>
                    {{ \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}
                </td>
                <td>
                    {{ $date->notes }}
                </td>
                <td>
                    {{ $date->location ?? '-' }}
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>

</div>
