@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="">{{ $item->stock_code }} at Bin {{ $item->bin }}
        @switch( $latest->line_status)
            @case('Accepted')
                 <span class="badge bg-success">Accepted</span>
            @break;
            @case('Matched')
               <span class="badge bg-success">Accepted</span>
            @break;
            @case('Not Counted')
                <span class="badge bg-warning">Not Counted</span>
                @break;
            @case('Needs Recount')
               <span class="badge bg-danger">Needs Recount</span>
            @break;

            @case('Recounted')
                <span class="badge bg-danger">Recounted</span>
            @break;

            @default
            <span class="badge bg-secondary">N/A</span>

            @break
        @endswitch

    </h1>
    <a href="{{ url('syspro/inventory/'. $item->inventory_id ) }}"
       class="btn btn-secondary">Back to Inventory Count</a>
    <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/bin/for/'. $item->bin ) }}"
       class="btn btn-primary">Back to Bin {{ $inventory->bin }}</a>

    <div class="row">
        <div class="col-md-6">
            <h2>Details</h2>
            <table class="table table-striped table-sm">
                <tbody>
                    <tr>
                        <td>Stock Code</td>
                        <td>
                            <a href="{{ url("/syspro/inventory/".$inventory->id."/search/stock_code/for/".trim($item->stock_code)."/All") }}">
                                {{ $item->stock_code }}</a>
                        </td>
                    </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $item->description_1 }}
                        @if ($item->description_2)
                            <br>
                            {{ $item->description_2 }}
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>Bin Location</td>
                    <td>
                        <a href="{{ url("/syspro/inventory/{$inventory->id}/search/bin/for/{$item->bin}/All") }}">
                            {{ $item->bin }}</a>
                    </td>
                </tr>
                <tr>
                    <td>Group</td>
                    <td>
                        <a href="{{ url("/syspro/inventory/{$inventory->id}/search/group/for/{$item->group}/All") }}">
                            {{ $item->group }}</a>
                    </td>
                </tr>
                <tr>
                    <td>Warehouse</td>
                    <td>
                        <a href="{{ url("/syspro/inventory/{$inventory->id}/search/warehouse/for/{$item->warehouse}/All") }}">
                            {{ $item->warehouse }}</a></td>
                </tr>
                <tr>
                    <td>Locale</td>
                    <td>
                        <a href="{{ url("/syspro/inventory/{$inventory->id}/search/locale/for/{$item->locale}/All") }}">
                            {{ $item->locale }}</a>
                    </td>
                </tr>
                    <tr>
                        <td>Ticket Number</td>
                        <td>

                            {{ str_pad(  $item->ticket_number ?? "NEW TICKET, MANUALLY CREATED"  ?? "NEW", 4, "0", STR_PAD_LEFT) }}
                        </td>
                    </tr>


                @if (Auth::user()->inventory_admin)
                    <tr>
                        <td> ID NUMBER</td>
                        <td>
                            {{ $item->id }}
                        </td>
                    </tr>
                    <tr>
                        <td>Expected Quantity</td>
                        <td>{{ $item->expected_quantity }}</td>
                    </tr>
                    <tr>
                        <td>Cost</td>
                        <td>$ {{ $item->cost }}</td>
                    </tr>
                    <tr>
                        <td>Expected Value</td>
                        <td>{{ $item->cost * $item->expected_quantity }}</td>
                    </tr>
                    @if(  $item->counts->count() )

                    <tr>
                        <td>Latest Value</td>
                        <td>{{ $item->cost *  $item->counts->first()->counted }}</td>
                    </tr>
                    <tr>
                        <td>Variance</td>
                        <td>{{ ($item->cost * $item->expected_quantity)
                    - ($item->cost *  $item->counts->first()->counted ) }}
                        @if ( $item->counts->first()->accepted )
                                <span class="badge badge-info">Accepted</span>
                            @elseif( !$item->counts->first()->accepted && $latest->line_status != "Matched" )
                                <form method="post" action="{{ url('/syspro/inventory/'.$inventory->id.'/acceptCount') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->counts->first()->id }}" name="count_id" id="count_id">
                                    <input type="submit" class="btn btn-info" value="Accept Count">
                                </form>

                            @else

                            @endif





                        </td>
                    </tr>
                        @else
                        <tr>
                            <td>Latest Value</td>
                            <td>Not yet counted</td>
                        </tr>
                        @endif
                @endif

                    <tr>
                        <td>Unit of Measure</td>
                        <td>{{ $item->unit_of_measure }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="col-md-6">
            <h2>Count history</h2>

            <table class="table table-striped table-sm">

                <thead>
                <tr>
                    <th>Counter</th>
                    <th>Quantity</th>
                    <th>Time</th>
                    <th>Entered By</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $item->counts as $count)
                    <tr>
                        <td>{{ $count->counter_name }}</td>
                        <td>{{ $count->counted }}</td>
                        <td>{{ $count->created_at }}</td>
                        <td>{{ $count->user->first_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if (  $item->counts && $item->counts->first() && $item->counts->first()->recounted )
                <span class="badge badge-danger">Marked as Recounted</span>
            @elseif( $item->counts && $item->counts->first() &&  !$item->counts->first()->recounted && $latest->line_status != "Matched" )
                <form method="post" action="{{ url('/syspro/inventory/'.$inventory->id.'/markAsRecounted') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->counts->first()->id }}" name="count_id" id="count_id">
                    <input type="submit" class="btn btn-warning" value="Mark as Recounted">
                </form>

            @else

            @endif



            <br>
            <hr>
            <br>

            <h2 class="">
                @if ( $item->counts->count() === 0 )
                Take Count
                @else
                    Replace Count
                    @endif

                    for {{ $item->stock_code }}  at Bin {{ $item->bin }}</h2>

            @includeIf('syspro::InventoryCounts.errors')

            <form class="form"
                  action="{{ url('syspro/inventory/'. $item->inventory_id.'/items/'.$item->id.'/counts/create') }}"
                  method="POST">
                {{ csrf_field() }}



                <div class="input-group input-group-lg mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Count</span>
                    <input type="text"
                           class="form-control"
                           required
                           id="counted"
                           value="{{ old('counted') }}"
                           name="counted"
                           aria-label=""
                           aria-describedby="">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
                    <input type="text"
                           class="form-control"
                           placeholder="Employee Name"
                           id="counter_name"
                           value="{{ old('counter_name') ?? Session::get('counter_name')  }}"
                           name="counter_name"
                           aria-label=""
                           aria-describedby="">
                </div>




                <div>
                    <input type="submit" value="Save Count" class="btn btn-success btn-lg">
                </div>
            </form>

        </div>
    </div>





    @if ($item->previousID)
        <a href="/syspro/inventory/{{ $inventory->id }}/items/{{ $item->previousUncountedId }}" class="btn btn-dark btn-lg">&lt; (J) Previous To Count In Group</a> &nbsp;
    @endif
    @if ($item->nextID)
        <a href="/syspro/inventory/{{ $inventory->id }}/items/{{ $item->nextUncountedID }}" class="btn btn-dark btn-lg">Next To Count In Group (K) &gt;</a>
    @endif

    <br><br>

    @if ($item->previousID)
        <a href="/syspro/inventory/{{ $inventory->id }}/items/{{ $item->previousId }}" class="btn btn-secondary btn">&lt; Previous In Group</a> &nbsp;
    @endif
    @if ($item->nextID)
        <a href="/syspro/inventory/{{ $inventory->id }}/items/{{ $item->nextID }}" class="btn btn-secondary btn">Next In Group&gt;</a>
    @endif


    @endsection


@section('scripts')
    <script>
        document.getElementById('counted').focus();

        document.getElementById('counted')
            .addEventListener('keydown', function (event) {


            @if ($item->previousUncountedId)
                if (event.key === 'j' || event.key === 'J' ) {
                    window.location.href = '/syspro/inventory/{{ $inventory->id }}/items/{{ $item->previousUncountedId }}';
                }
            @endif
                @if ($item->nextUncountedID)
            if (event.key === 'k' || event.key === 'K') {
                window.location.href = '/syspro/inventory/{{ $inventory->id }}/items/{{ $item->nextUncountedID }}';
            }
            @endif

        });
    </script>
    @endsection
