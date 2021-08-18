@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">Warranty &amp; Customer for {{ $vehicle->identifier }}</h1>
        </div>
    </div>


    @if ( $vehicle->warranty_submitted )
        <div class="alert alert-danger" role="alert">
           This warranty has been registered, meaning that the current or future customers won't be able to submit the registration form again. The warranty registration form can be unlocked by clicking <a class="btn btn-danger" href="{{ url('/vehicles/'.$vehicle->id.'/warrantyToggle') }}">Here</a>
        </div>
    @else
        <div class="alert alert-info" role="alert">
            This warranty has not been registered, meaning that the current or future customers is able to submit the registration form. If you make changes to this page and the customer later submits a warranty registration, this informaiton will be overwritten..The warranty registration form can be locked by clicking <a class="btn btn-info" href="{{ url('/vehicles/'.$vehicle->id.'/warrantyToggle') }}">Here</a>
        </div>

        @endif
 <br>









    @includeIf('vehicles::errors')

    <form method="POST" action="{{ url('vehicles/'.$vehicle->id .'/warrantyAndCustomer') }}">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}


        <div class="row">

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="date_of_purchase">Date of Purchase</label>
                    <input type="date"
                           name="date_of_purchase"

                           value="{{ old('date_of_purchase') ?? $vehicle->date_of_purchase ?? "" }}"
                           id="date_of_purchase"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="date_warranty_registered">Date Warranty Registered</label>
                    <input type="date"
                           name="date_warranty_registered"

                           value="{{ old('date_warranty_registered') ?? $vehicle->date_warranty_registered ?? "" }}"
                           id="date_warranty_registered"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="date_warranty_expiry">Date Warranty Expires</label>
                    <input type="date"
                           name="date_warranty_expiry"

                           value="{{ old('date_warranty_expiry') ?? $vehicle->date_warranty_expiry ?? "" }}"
                           id="date_warranty_expiry"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="warranty_selling_dealer">Selling Dealer</label>
                    <input type="text"
                           name="warranty_selling_dealer"
                           list="dealerList"

                           value="{{ old('warranty_selling_dealer')  ?? $vehicle->warranty_selling_dealer  ?? $vehicle->dealer->name ?? "" }}"
                           id="warranty_selling_dealer"
                           class="form-control form-control-lg">
                </div>
            </div>




            <datalist id="dealerList">
                @foreach(\App\Models\Company::pluck('name') as $name )
                    <option value="{{ $name }}" >
                @endforeach
            </datalist>


            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="warranty_odometer">Odometer at Purchase </label>
                    <input type="number"
                           name="warranty_odometer"

                           value="{{ old('warranty_odometer') ?? $vehicle->warranty_odometer  ?? "" }}"
                           id="warranty_odometer"
                           class="form-control form-control-lg">
                </div>
            </div>





        </div>

        <hr>










        <div class="row">
            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_name">Customer Name</label>
                    <input type="text"
                           name="customer_name"

                           value="{{ old('customer_name') ?? $vehicle->customer_name  ?? "" }}"
                           id="customer_name"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_email">Email </label>
                    <input type="text"
                           name="customer_email"
                           value="{{ old('customer_email') ?? $vehicle->customer_email  ?? "" }}"
                           id="customer_email"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_phone">Phone </label>
                    <input type="text"
                           name="customer_phone"
                           value="{{ old('customer_phone') ?? $vehicle->customer_phone  ?? "" }}"
                           id="customer_email"
                           class="form-control form-control-lg">
                </div>
            </div>


        </div>



<hr>



        <div class="row">

            <div class='col-md-8'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_address_1">Address</label>
                    <input type="text"
                           name="customer_address_1"

                           value="{{ old('customer_address_1') ?? $vehicle->customer_address_1  ?? "" }}"
                           id="customer_address_1"
                           class="form-control form-control-lg">
                </div>
            </div>

        </div>
        <div class="row">

            <div class='col-md-8'>
                <div class="form-group">

                    <input type="text"
                           name="customer_address_2"
                           aria-label=""

                           value="{{ old('customer_address_2') ?? $vehicle->customer_address_2  ?? "" }}"
                           id="customer_address_2"
                           class="form-control form-control-lg">
                </div>
            </div>

        </div>
        <div class="row">


            <div class='col-md-4'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_city">City</label>
                    <input type="text"
                           name="customer_city"

                           value="{{ old('customer_city') ?? $vehicle->customer_city ?? "" }}"
                           id="customer_city"
                           class="form-control form-control-lg">
                </div>
            </div>
            <div class='col-md-2'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_province">Province / State </label>
                    <input type="text"
                           name="customer_province"

                           value="{{ old('customer_province') ?? $vehicle->customer_province  ?? "" }}"
                           id="customer_province"
                           class="form-control form-control-lg">
                </div>
            </div>

            <div class='col-md-2'>
                <div class="form-group">
                    <label class="control-label"
                           for="customer_postalcode">Postal / ZIP </label>
                    <input type="text"
                           name="customer_postalcode"

                           value="{{ old('customer_postalcode') ?? $vehicle->customer_postalcode  ?? "" }}"
                           id="customer_postalcode"
                           class="form-control form-control-lg">
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Save Changes" class="btn btn-primary">
            </div>
        </div>
    </form>
@endsection

