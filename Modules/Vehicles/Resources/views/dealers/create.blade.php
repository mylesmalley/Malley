@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">Dealers
            </h1>
        </div>
    </div>
    @includeIf('vehicles::errors')
<form method="POST"
      action="{{ url('vehicles/dealers') }}"
      accept-charset="UTF-8"
      role="form"
      class="form-horizontal">

    {{ csrf_field() }}

    <h2>Corporate</h2>

    <div class="form-group ">
        <label for="name"
               class="control-label col-sm-2 col-md-3">Company Name</label>
        <div class="col-md-6">
            <input class="form-control"
                   value="{{ old('name') ?? '' }}"
                   required
                   id="name"
                   name="name"
                   type="text">
        </div>
    </div>
{{--    <div class="form-group "><label for="address_1" class="control-label col-sm-2 col-md-3">Address</label><div class="col-md-6"><input class="form-control" id="address_1" name="address_1" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="address_2" class="control-label col-sm-2 col-md-3"> </label><div class="col-md-6"><input class="form-control" id="address_2" name="address_2" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="address_3" class="control-label col-sm-2 col-md-3"> </label><div class="col-md-6"><input class="form-control" id="address_3" name="address_3" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="city" class="control-label col-sm-2 col-md-3">City</label><div class="col-md-6"><input class="form-control" id="city" name="city" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="province" class="control-label col-sm-2 col-md-3">State / Province</label><div class="col-md-6"><input class="form-control" id="province" name="province" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="country" class="control-label col-sm-2 col-md-3">Country</label><div class="col-md-6"><input class="form-control" id="country" name="country" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="postalcode" class="control-label col-sm-2 col-md-3">Postal / Zip</label><div class="col-md-6"><input class="form-control" id="postalcode" name="postalcode" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="phone" class="control-label col-sm-2 col-md-3">Phone</label><div class="col-md-6"><input class="form-control" id="phone" name="phone" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="fax" class="control-label col-sm-2 col-md-3">fax</label><div class="col-md-6"><input class="form-control" id="fax" name="fax" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="website" class="control-label col-sm-2 col-md-3">Website</label><div class="col-md-6"><input class="form-control" id="website" name="website" type="text"></div></div>--}}


{{--    <h2>Service</h2>--}}

{{--    <div class="form-group "><label for="service_address_1" class="control-label col-sm-2 col-md-3">Address </label><div class="col-md-6"><input class="form-control" id="service_address_1" name="service_address_1" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_address_2" class="control-label col-sm-2 col-md-3"> </label><div class="col-md-6"><input class="form-control" id="service_address_2" name="service_address_2" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_address_3" class="control-label col-sm-2 col-md-3"> </label><div class="col-md-6"><input class="form-control" id="service_address_3" name="service_address_3" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_city" class="control-label col-sm-2 col-md-3">City </label><div class="col-md-6"><input class="form-control" id="service_city" name="service_city" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_province" class="control-label col-sm-2 col-md-3">Province </label><div class="col-md-6"><input class="form-control" id="service_province" name="service_province" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_country" class="control-label col-sm-2 col-md-3">Country </label><div class="col-md-6"><input class="form-control" id="service_country" name="service_country" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_postalcode" class="control-label col-sm-2 col-md-3">Postal / Zip </label><div class="col-md-6"><input class="form-control" id="service_postalcode" name="service_postalcode" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_phone" class="control-label col-sm-2 col-md-3">Service Phone</label><div class="col-md-6"><input class="form-control" id="service_phone" name="service_phone" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_fax" class="control-label col-sm-2 col-md-3">Service Fax</label><div class="col-md-6"><input class="form-control" id="service_fax" name="service_fax" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_manager" class="control-label col-sm-2 col-md-3">Service Manager</label><div class="col-md-6"><input class="form-control" id="service_manager" name="service_manager" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_email" class="control-label col-sm-2 col-md-3">Service Email</label><div class="col-md-6"><input class="form-control" id="service_email" name="service_email" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_technicians" class="control-label col-sm-2 col-md-3"># of Service Techs</label><div class="col-md-6"><input class="form-control" id="service_technicians" name="service_technicians" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_hours" class="control-label col-sm-2 col-md-3">Hours of Operation</label><div class="col-md-6"><input class="form-control" id="service_hours" name="service_hours" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_emergency" class="control-label col-sm-2 col-md-3">Emergency / After Hours</label><div class="col-md-6"><input class="form-control" id="service_emergency" name="service_emergency" type="text"></div></div>--}}
{{--    <div class="form-group "><label for="service_capabilities" class="control-label col-sm-2 col-md-3">Service Capabilities</label><div class="col-md-6"><textarea class="form-control" id="service_capabilities" name="service_capabilities" cols="50" rows="10"></textarea></div></div>--}}
{{--    <div class="form-group "><label for="service_other" class="control-label col-sm-2 col-md-3">Other Services / Notes </label><div class="col-md-6"><textarea class="form-control" id="service_other" name="service_other" cols="50" rows="10"></textarea></div></div>--}}







    <div class="form-group">
        <div class="col-sm-offset-2 col-md-offset-3 col-md-6">
            <input class="btn btn-primary"
                   type="submit"
                   value="Save Dealer"></div>
    </div>

</form>

    @endsection
