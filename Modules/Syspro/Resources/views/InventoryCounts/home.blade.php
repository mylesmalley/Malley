{{--
    HOME PAGE FOR ALL INVENTORY COUNTS
 --}}
@extends('syspro::InventoryCounts.template')

@section('content')
    <h1 class="">All Counts</h1>



    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Locked</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse( $counts as $count )
            <tr>
                <td>{{ $count->id }}</td>
                <td>{{ $count->created_at }}</td>
                <td>{{ $count->description }}</td>
                <td>{{ $count->locked ? "Locked" : "Open" }}</td>
                <td>
                    <a href="{{ url('syspro/inventory/'.$count->id) }}"
                       class="btn btn-primary">Open</a></td>
            </tr>
                @empty
                <tr>
                    <td colspan="3">No counts yet!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

{{--    <a href="{{ url('syspro/inventory/create') }}"--}}
{{--       class="btn btn-secondary">New Count</a>--}}
    *Create a new count by running the new count generation sql script.
@endsection


