@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1>Add A New Vehicle</h1>
        </div>
    </div>

    @includeIf('vehicles::errors')


    <form method="POST" action="{{ url('vehicles') }}">
        {{ csrf_field() }}
    <div class="row">

                <div class="col-md-2"></div>
                <div class='col-md-8'>

                    <div class="card border-primary document-content-wrapper">
                        <div class="card-body">

                            <div class="form-group">
                                <label class="control-label" for="vin">VIN</label>
                                <input type="text"
                                       name="vin"
                                       id="vin"
                                       value="{{ old('vin') ?? '' }}"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="work_order">Work Order #</label>
                                <input type="text"
                                       name="work_order"
                                       value="{{ old('work_order') ?? '' }}"

                                       id="work_order" class="form-control">
                            </div>

                            <div class="form-group" style="display:none;">
                                <label class="control-label" for="malley_number">Malley ID</label>
                                <input type="text"
                                       name="malley_number"
                                       value="{{ old('malley_number') ?? '' }}"

                                       id="malley_number" class="form-control">
                            </div>


                            <div class="form-group">
                                <label class="control-label" for="customer_name">Customer Name</label>
                                <input type="text"
                                       name="customer_name"
                                       value="{{ old('customer_name') ?? '' }}"

                                       id="customer_name" class="form-control">
                            </div>
                            <br />
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Save New Vehicle</button>

                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
    </div>

        </form>
@endsection
