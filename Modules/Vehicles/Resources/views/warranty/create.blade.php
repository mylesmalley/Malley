@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">New Warranty Claim </h1>

                <h2 class="text-center text-secondary">for {{ $vehicle->identifier }}</h2>


    @includeIf('vehicles::errors')

    <div class="card border-primary document-content-wrapper">
        <div class="card-body">

    <form method="POST" action="{{ url('/vehicles/'.$vehicle->id .'/warrantyclaim') }}">
        {{ csrf_field() }}
        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}" id="vehicle_id ">

    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control"
                       name="first_name"
                       value="{{ old('first_name', Auth::user()->first_name ) }}"
                       id="first_name" placeholder="First Name">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control"
                       name="last_name"
                       value="{{ old('last_name', Auth::user()->last_name ) }}"
                       id="last_name" placeholder="Last Name">
            </div>
        </div>

        <div class="col-2">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control"
                       name="phone"
                       value="{{ old('phone', $vehicle->dealer->phone ) }}"
                       id="phone" placeholder="Tel">
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control"
                       name="email"
                       value="{{ old('email', Auth::user()->email ) }}"
                       id="email" placeholder="Last Name">
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label for="organization">Dealer / Customer</label>
                <input type="text" class="form-control"
                       name="organization"
                       value="{{ old('organization', $vehicle->dealer->name ) }}"
                       id="organization" placeholder="Organization">
            </div>
        </div>


        <div class="col-3">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date"
                       id="date"
                       class="form-control" name="date"
                       max="{{ date('Y-m-d') }}"
                       value="{{ old('date') ?? date("Y-m-d") }}" />
            </div>
        </div>



    </div>

    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <label for="make">Make</label>
                <input type="text" class="form-control"
                       readonly
                       name="make"
                       value="{{ old('make', $vehicle->make ) }}"
                       id="make" placeholder="Make">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control"
                       readonly
                       name="model"
                       value="{{ old('model', $vehicle->model ) }}"
                       id="model" placeholder="Model">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" class="form-control"
                       readonly
                       name="year"
                       value="{{ old('year', $vehicle->year ) }}"
                       id="year" placeholder="Year">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label for="mileage">Mileage</label>
                <input type="text" class="form-control"
                       name="mileage"
                       required
                       value="{{ old('mileage', $vehicle->mileage ) ?? 0 }}"
                       id="mileage" placeholder="Mileage">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="vin">VIN</label>
                <input type="text" class="form-control"
                       readonly
                       name="vin"
                       value="{{ old('vin', $vehicle->vin ) }}"
                       id="vin" placeholder="VIN">
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="issue">Issue</label><br />
                <textarea
                    name="issue"
                    id="issue"
                    class="form-control"
                    placeholder="Issue details"
                    cols="80"
                    rows="6">{{ old('issue') ?? "" }}</textarea>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="notes">Notes</label><br />
                    <textarea
                        name="notes"
                        id="notes"
                        class="form-control"
                        placeholder="Resolution Notes"
                        cols="80"
                        rows="6">{{ old('notes') ?? "" }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

            <a class="btn btn-lg btn-warning" href="{{ url('/vehicles/'.$vehicle->id) }}" >Cancel</a>
            &nbsp;&nbsp;
            <input type="submit" class="btn btn-lg btn-success" value="Save Warranty Claim">
            </div>

        </div>

    </form>

        </div>
    </div>
@endsection
