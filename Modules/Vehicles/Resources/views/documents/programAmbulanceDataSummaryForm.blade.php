@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="">Program Ambulance Data Summary for <a href="{{ url('vehicles/'.$vehicle->id) }}">{{ $vehicle->identifier }}</a></h1>
        </div>
    </div>





    @includeIf('vehicles::errors')

    <form method="POST" action="{{ url('/vehicles/'.$vehicle->id.'/documents/ProgramAmbulanceDataSummaryForm') }}">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}


        <div class="row">

            <div class="col-md-4">

                <div class="form-group">
                    <label class="control-label"
                           for="customer_number">Invoice Number</label>
                    <input type="text"
                           name="customer_number"
                           required
                           value="{{ old('customer_number') ?? $vehicle->customer_number ?? "" }}"
                           id="customer_number"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label class="control-label"
                           for="malley_number">malley_number Number</label>
                    <input type="text"
                           name="malley_number"
                           required
                           value="{{ old('malley_number') ?? $vehicle->malley_number ?? "" }}"
                           id="malley_number"
                           class="form-control form-control-lg">
                </div>
            </div>


        </div>




        <div class="row">



            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="finance_invoice_number">Invoice Number</label>
                    <input type="text"
                           name="finance_invoice_number"
                           required
                           value="{{ old('finance_invoice_number') ?? $vehicle->finance_invoice_number ?? "" }}"
                           id="finance_invoice_number"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="finance_pretax_invoice_value">Pretax Invoice Total</label>
                    <input type="text"
                           name="finance_pretax_invoice_value"
                           required
                           value="{{ round( old('finance_pretax_invoice_value') ?? $vehicle->finance_pretax_invoice_value ,2) ?? "" }}"
                           id="finance_pretax_invoice_value"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="finance_invoice_total_tax"> Invoice Tax</label>
                    <input type="text"
                           name="finance_invoice_total_tax"
                           required
                           value="{{ round( old('finance_invoice_total_tax') ?? $vehicle->finance_invoice_total_tax, 2) ?? "" }}"
                           id="finance_invoice_total_tax"
                           class="form-control form-control-lg">
                </div>
            </div>

        </div>

            <hr>

        <div class="row">


            @if(  !$vehicle->milestone('in_service') || !$vehicle->milestone('lease_expirey') )
                    <div class=" col-8 offset-2">

                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white">
                                Before you Start
                            </div>
                            <div class="card-body text-danger">
                                Please  <a href="{{ route('vehicle.dates', [ $vehicle ]) }}">click here</a> to set the IN SERVICE and LEASE EXPIRED date.
                            </div>
                        </div>
                    </div>

            @endif

{{--            --}}
{{--            <div class='col-md-4'>--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label"--}}
{{--                           for="date_in_service">Date In Service</label>--}}
{{--                    <input type="date"--}}
{{--                           name="date_in_service"--}}
{{--                           required--}}
{{--                           value="{{ old('date_in_service') ?? $vehicle->date_in_service ?? "" }}"--}}
{{--                           id="date_in_service"--}}
{{--                           class="form-control form-control-lg">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class='col-md-4'>--}}
{{--                <div class="form-group">--}}
{{--                    <label class="control-label"--}}
{{--                           for="date_lease_expired">Date Lease Expiress</label>--}}
{{--                    <input type="date"--}}
{{--                           name="date_lease_expired"--}}
{{--                           required--}}
{{--                           value="{{ old('date_lease_expired') ?? $vehicle->date_lease_expired ?? "" }}"--}}
{{--                           id="date_lease_expired"--}}
{{--                           class="form-control form-control-lg">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>


        <hr>

    <div class="row">

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="finance_lease_number">Lease Number</label>
                    <input type="text"
                           name="finance_lease_number"
                           required
                           value="{{ old('finance_lease_number') ?? $vehicle->finance_lease_number ?? "" }}"
                           id="finance_lease_number"
                           class="form-control form-control-lg">
                </div>
            </div>
        <div class='col-md-4'>
            <div class="form-group">
                <label class="control-label"
                       for="finance_monthly_lease_pretax">Monthly Lease (Pre tax)</label>
                <input type="text"
                       name="finance_monthly_lease_pretax"
                       required
                       value="{{ round( old('finance_monthly_lease_pretax') ??
                                 $vehicle->finance_monthly_lease_pretax, 2 ) ?? "" }}"
                       id="finance_monthly_lease_pretax"
                       class="form-control form-control-lg">
            </div>
        </div>

        <div class='col-md-4'>
            <div class="form-group">
                <label class="control-label"
                       for="finance_monthly_lease_tax">Monthly Lease tax</label>
                <input type="text"
                       name="finance_monthly_lease_tax"
                       required
                       value="{{ round( old('finance_monthly_lease_tax') ?? $vehicle->finance_monthly_lease_tax, 2) ?? "" }}"
                       id="finance_monthly_lease_tax"
                       class="form-control form-control-lg">
            </div>
        </div>







    </div>

        <hr>

        <div class="row">
            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="refurb_number">Refurb Number</label>
                    <input type="text"
                           name="refurb_number"
                           require d
                           value="{{  old('refurb_number') ?? $vehicle->refurb_number ?? "" }}"
                           id="refurb_number"
                           class="form-control form-control-lg">
                </div>
            </div>
        </div>


        <input type="submit" class="btn btn-lg btn-primary" value="SAVE">

    </form>

    @endsection
