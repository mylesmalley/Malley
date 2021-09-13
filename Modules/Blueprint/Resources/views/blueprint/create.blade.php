@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> Create a New Blueprint </h1>
            <h3 class="text-secondary">{{ $baseVan->name ?? 'Van' }}</h3>

        </div>
    </div>

    <div class="row">

        <form action="{{ route('blueprint.store') }}" method="POST">
            @csrf
            <input type="hidden" name="base_van_id" value="{{ $baseVan->id }}">

        <div class=" col-10 offset-1">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Details
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-6 border-primary border-end-">
                            <h3>About This Blueprint</h3>

                            <div class="row">
                                <div class="col-12">
                                    @error('name') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="name">Name</label>
                                    <input class="form-control form-control-sm"
                                           type="text"
                                           required
                                           value="{{ old('name') }}"
                                           id="name" name="name"
                                           placeholder="Blueprint Name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    @error('description') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="description">Description</label>
                                    <input class="form-control form-control-sm"
                                           type="text"
                                           required
                                           value="{{ old('description') }}"
                                           id="description" name="description"
                                           placeholder="Blueprint description">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label for="platform">Platform</label>
                                    <input class="form-control form-control-sm"
                                           type="text"
                                           readonly
                                           id="platform" name="platform"
                                           value="{{ $baseVan->name }}">
                                </div>
                            </div>
                        </div>











                        <div class="col-6">


                            <h3>Customer Details <span style="font-size:small;" class="text-secondary">(if available)</span></h3>
                            <div class="row">
                                <div class="col-12">
                                    @error('customer_name') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="customer_name">Name</label>
                                    <input class="form-control form-control-sm"
                                           type="text"
                                           value="{{ old('customer_name') }}"
                                           id="customer_name" name="customer_name"
                                           placeholder="Customer Name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    @error('bcustomer_address_1') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    @error('customer_address_2') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="customer_address_1">Street</label>
                                    <input class="form-control"
                                           type="text"
                                           value="{{ old('customer_address_1') }}"
                                           id="customer_address_1" name="customer_address_1"
                                           placeholder="Street">

                                    <input class="form-control"
                                           type="text"
                                           value="{{ old('customer_address_2') }}"
                                           aria-label="street 2"
                                           id="customer_address_2" name="customer_address_2"
                                           placeholder="P.O. Box">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-4">
                                    @error('customer_city') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="customer_city">City</label>
                                    <input class="form-control"
                                           type="text"
                                           value="{{ old('customer_city') }}"
                                           id="customer_city"
                                           name="customer_city"
                                           placeholder="Smithville">
                                </div>
                                <div class="col-4">
                                    @error('customer_province') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="customer_province">State / Prov</label>
                                    <input class="form-control"
                                           type="text"
                                           value="{{ old('customer_province') }}"
                                           id="customer_province"
                                           name=customer_province"
                                           placeholder="Montana">
                                </div>
                                <div class="col-4">
                                    @error('customer_country') <span class="text-danger">{{ $message }}</span><br> @enderror
                                    <label for="customer_country">Country</label>
                                    <input class="form-control"
                                           type="text"
                                           value="{{ old('customer_country') }}"
                                           id="customer_country" name=customer_country"
                                           placeholder="USA">
                                </div>
                            </div>



                        </div>
                    </div>


                    <br>

                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-success" value="Get Started">
                        </div>
                    </div>
                </div>


            </div>




        </div>

        </form>

    </div>





    <br>



@endsection