<div class="card border-primary">
    <div class="card-header bg-primary text-white" >

        Inspection History
        @if( Auth::user()->vdb_modify_inspections )
            <a href="{{ url('vehicles/'.$vehicle->id.'/inspections' ) }}"
             class='btn btn-sm btn-secondary float-end'>Edit Inspections</a>
        @endif
    </div>




    <table class="table table-sm table-striped table-hover">
        <thead>
        <tr>
            <th> Date </th>
            <th> Descriptions </th>
            <th> Category </th>
            <th> Location </th>
            <th> Type </th>
            <th> Source </th>
            <th> Severity </th>
        </tr>
        </thead>
        <tbody>


        @forelse( $vehicle->inspections as $inspection)
            <tr>
                <td> {{ $inspection->date_entered }}  </td>
                <td> {{ $inspection->description  }} </td>
                <td> {{ $inspection->life_step }}  </td>
                <td> {{ $inspection->location }}</td>
                <td> {{ $inspection->type }}</td>
                <td> {{ $inspection->source }}</td>
                <td> {{ $inspection->severity }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No inspection issues!</td>
            </tr>
        @endforelse
        </tbody>
    </table>


</div>
