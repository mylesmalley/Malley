@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Ambulance Build List</h1>

    {!! $rows->links() !!}

    <div class="card border-primary document-content-wrapper

">

    <table class="table
    d-print-table
    table-striped table-sm table-hover">
        <thead>
            <tr>
                <th class="d-print-table-cell">A#</th>
                <th class="d-print-table-cell">Customer #</th>
                <th class="d-print-table-cell">Customer (Dealer)</th>

                <th class="d-print-table-cell">Refurb #</th>

                <th class="d-print-table-cell">Vehicle</th>
                <th class="d-print-table-cell">VIN</th>
                <th class="d-print-table-cell">Lease Expiry Date</th>
                <th class="d-print-table-cell">Delivery Date</th>
                <th class="d-print-none"></th>
            </tr>
        </thead>
        <tbody>

        @forelse( $rows as $row )
            <tr class="d-print-table-row">
                <td class="d-print-table-cell">{{ $row->malley_number }}</td>
                <td  class="d-print-table-cell">{{ $row->customer_number  }}

                </td>
                <td class="d-print-table-cell">{{ $row->customer_name }}   <br>
                    ({{ $row->dealer->name }})</td>
                <td class="d-print-table-cell">{{ $row->refurb_number }}</td>

                <td class="d-print-table-cell">{{ $row->year }} {{ $row->make }} {{ $row->model }}</td>
                <td class="d-print-table-cell">{{ $row->vin }}</td>

                <td class="d-print-table-cell">{{ $row->date_lease_expiry_of_refurb ?? "" }}</td>
                <td class="d-print-table-cell">{{ $row->date_delivery ?? "" }}</td>

                <td  class="d-print-none"><a href="{{ url('/vehicles/'.$row->id) }}" class="btn btn-sm btn-success">View</a></td>
            </tr>
        @empty

        @endforelse
        </tbody>

    </table>

    </div>

    {!! $rows->links() !!}

@endsection
