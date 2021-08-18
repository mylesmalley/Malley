@extends('syspro::template')

@section('content')
    <h1>Please Order
        <span class="float-right">
            <a href="{{ url('/syspro/purchasing/newRequest') }}"
               class="btn btn-lg btn-primary">Add New</a>
        </span>
    </h1>

    <div class="container d-none d-md-block" style="color:white; background-color: darkgreen;">
        <div class="row" >
            <div class="col-2">
                Person
            </div>
            <div class="col-4">
                Part &amp;
                Description
            </div>
            <div class="col-1">
                Quantity
            </div>
            <div class="col-3">
                Priority,
                For Job
            </div>
            <div class="col-2">
                Status
            </div>
        </div>
    </div>

    <div class="container">
        @forelse( $items as $item )
        <div class="row {{ $item->hasArrived() ? "text-muted" : '' }} " >
            <div class="col-sm-2 report-column">
                {{ $item->user->first_name . ' ' . $item->user->last_name }}<br >
                {{ $item->created_at->format('Y-m-d H:i') }}
            </div>
            <div class="col-sm-4 report-column">
                {!! e($item->part_number) ? e($item->part_number). " - " : "" !!}
                {{ $item->description }}<br />
                {{ $item->notes }}
            </div>
            <div class="col-sm-1 report-column">
                {{ $item->quantity . ' ' . $item->unit_of_measure }}
            </div>
                        <div class="col-sm-3 report-column">

                {{ !$item->hasArrived() ?
                    $purchaseRequest::urgencies()[$item->urgency] :
                    '' }}
         <br />
                {{ $item->job }}
            </div>
            <div class="col-sm-2 report-column">
                @if( !$item->hasArrived() )
                {{ $purchaseRequest::statuses()[ $item->status ] }}
                @if( Auth::user()->can_edit_purchase_requests )
                    <a href="{{ url('syspro/purchasing/'.$item->id.'/editRequest') }}" class="btn btn-sm btn-secondary">Edit</a>
                @endif
                    @endif
            </div>
        </div>


            @empty
                    <div class="col-sm-12">
                        Nothing on order, yet...
                    </div>
            @endforelse



            {{ $items->links() }}

    </div>

    @endsection


    @section('stylesheet')
        <style>

            .report-column
            {
                font-size: 12pt;
            }
            /*.row {*/
            /*    border: 2px solid darkgreen;*/
            /*}*/
            .row:nth-child(even) {
                background: #e0e0e0;
            }

        </style>
        @endsection
