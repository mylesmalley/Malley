@extends('vehicles::layout')

@section('content')

            <h1 class="text-center">Edit Details</h1>
            <h2 class="text-center text-secondary">For {{ $vehicle->identifier }}</h2>

    @includeIf('vehicles::errors')
            <div class="card border-primary document-content-wrapper">
                <div class="card-body">

    <form method="POST" action="{{ url('vehicles/'.$vehicle->id) }}">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}



        <div class='row'>
            <div class='col-md-4'>
                <h3>About</h3>
                <div class="form-group">
                    <label class="control-label" for="customer_name">Customer Name</label>
                    <input type="text"
                           name="customer_name"
                           value="{{ old('customer_name') ?? $vehicle->customer_name ?? "" }}"
                           id="customer_name"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label class="control-label" for="vin">VIN</label>
                    <input type="text"
                           name="vin"
                           value="{{ old('vin') ?? $vehicle->vin ?? "" }}"
                           id="vin"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="malley_number">Malley ID</label>
                    <input type="text"
                           name="malley_number"
                           value="{{ old('malley_number') ?? $vehicle->malley_number ?? "" }}"
                           id="malley_number"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="customer_number">Customer's Reference Number</label>
                    <input type="text"
                           value="{{ old('customer_number') ?? $vehicle->customer_number ?? "" }}"
                           name="customer_number"
                           id="customer_number"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="company_id">Dealer</label>
                    <select name="company_id"
                            id="company_id"
                            class="form-control">
                        @foreach( \App\Models\Company::orderBy('name')->get() as $company)
                            <option value="{{ $company->id }}"
                                {{ $company->id == $vehicle->company_id ? "selected" : '' }}
                            >
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label" for="work_order">Work Order(s) #</label><br>
                    <small class="text-info">Add multiple work orders by serating with commas. Original work order must be first.</small>

                    <input type="text"
                           value="{{ old('work_order') ?? $vehicle->work_order ?? "" }}"
                           name="work_order"
                           id="work_order"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="refurb_number">Refurb Number</label>
                    <input type="text"
                           value="{{ old('refurb_number') ?? $vehicle->refurb_number ?? "" }}"
                           name="refurb_number"
                           id="refurb_number"
                           class="form-control">
                </div>
{{--                <div class="form-group">--}}
{{--                    <label class="control-label" for="location">Location</label>--}}
{{--                    <select name="location" id="location" class="form-control">--}}
{{--                        <option value="In Service" selected>In Service</option><option value="On Order">On Order</option><option value="Dieppe">Dieppe</option><option value="Olathe Ford">Olathe Ford</option></select>--}}
{{--                </div>--}}
            </div>
            <div class='col-md-4'>
                <h3>Vehicle Specs</h3>
                <div class="form-group">
                    <label class="control-label" for="make">Make</label>
                    <input type="text"
                           name="make"
                           value="{{ old('make') ?? $vehicle->make ?? "" }}"
                           id="make" class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="model">Model</label>
                    <input type="text"
                           name="model"
                           value="{{ old('model') ?? $vehicle->model ?? "" }}"
                           id="model"

                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="year">Year</label>
                    <input type="text"
                           name="year"
                           value="{{ old('year') ?? $vehicle->year ?? "" }}"
                           id="year"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="country">Country</label>
                    <select class="form-control" name="country" id="country">
                        @foreach([
                            "",
                            "Canada",
                            "United States"
                        ] as $country)
                        <option
                           @if (   old('country') === $country || $vehicle->country === $country )
                                selected
                               @endif
                        >{{ $country }}</option>


                            @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label class="control-label" for="drive">Drive</label>
                    <input type="text"
                           name="drive"
                           id="drive"
                           value="{{ old('drive') ?? $vehicle->drive ?? "" }}"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="fuel">Fuel Type</label>

                    <input type="text"
                           name="fuel"
                           value="{{ old('fuel') ?? $vehicle->fuel ?? "" }}"
                           id="fuel"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="wheelbase">Wheelbase</label>
                    <div class="input-group">
                        <input type="text"
                               name="wheelbase"
                               value="{{ old('wheelbase') ?? $vehicle->wheelbase ?? "" }}"
                               id="wheelbase"
                               class="form-control">
                        <span class="input-group-text" title='Regular, extended, 136"...'>?</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="roof_height">Roof Height</label>
                    <div class="input-group">
                        <input type="text"
                               name="roof_height"
                               value="{{ old('roof_height') ?? $vehicle->roof_height ?? "" }}"
                               id="roof_height"
                               class="form-control">
                        <span class="input-group-text" title='Regular, Medium, High Roof etc...'>?</span>
                    </div>
                </div>


{{--                <div class="form-group">--}}
{{--                    <label class="control-label" for="manufacturer_code">Manufacturer Code</label>--}}
{{--                    <input type="text"--}}
{{--                           value="{{ old('manufacturer_code') ?? $vehicle->manufacturer_code ?? "" }}"--}}
{{--                           name="manufacturer_code"--}}
{{--                           id="manufacturer_code"--}}
{{--                           class="form-control">--}}
{{--                </div>--}}



            </div>
            <div class='col-md-4'>
                <h3>Other</h3>
                <div class="form-group">
                    <label class="control-label" for="notes">Notes</label>
                    <textarea name="notes"
                              rows="10"
                              cols="50"
                              id="notes"
                              class="form-control">{{ old('notes') ?? $vehicle->notes ?? "" }}</textarea>
                </div>

                <div class="form-group">
                    <label class="control-label" for="exterior_colour">Exterior Colour</label>
                    <input type="text"
                           name="exterior_colour"
                           value="{{ old('exterior_colour') ?? $vehicle->exterior_colour ?? "" }}"
                           id="exterior_colour"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="oem_dealer">OEM Dealer (e.g. Olathe Ford)</label>
                    <input type="text"
                           name="oem_dealer"
                           value="{{ old('oem_dealer') ?? $vehicle->oem_dealer ?? "" }}"
                           id="oem_dealer"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label class="control-label" for="interior_colour">Interior Colour</label>
                    <input type="text"
                           name="interior_colour"
                           value="{{ old('interior_colour') ?? $vehicle->interior_colour ?? "" }}"
                           id="interior_colour"
                           class="form-control">
                </div>


            </div>
        </div>
        <br />
        <div class='row'>
            <div class='col-md-12'>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Save Changes</button>

            </div>
        </div>



    </form>


            </div>
            </div>
    <br /><br />
@endsection
