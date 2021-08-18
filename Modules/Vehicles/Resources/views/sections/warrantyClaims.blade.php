<div class="card border-primary">
    <div class="card-header bg-primary text-white">
      Warranty Claim History

    @if( Auth::user()->vdb_work_orders )

    <a href="{{ url('vehicles/'.$vehicle->id.'/warrantyclaim' ) }}"
       class='btn btn-sm btn-secondary float-end'>Create Claim</a>
        @endif

    </div>


    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Issue
            </th>
            <th>

                Date
            </th>
            <th>Notes</th>
            @if( Auth::user()->vdb_work_order_from_warranty_claim )
                <th>

                </th>
            @endif
        </tr>
        </thead>
        <tbody>


        @forelse( $claims as $claim)
            <tr onclick="location.href='{{ url('/vehicles/'.$vehicle->id.'/warrantyClaim/'.$claim->id ) }}'">
                <td>
                    {{ $claim->first_name . ' ' . $claim->last_name }}
                </td>
                <td>
                    {{ $claim->issue  }}
                </td>
                <td>{{ $claim->date }}</td>
                <td>{{ $claim->notes }}</td>
                @if( Auth::user()->vdb_work_order_from_warranty_claim )
                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('workOrderFromWarrantyClaim', [$claim]) }}">Create Work Order</a>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="5">No warranty claims for this van!</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

