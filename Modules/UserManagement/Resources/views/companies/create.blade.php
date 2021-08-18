@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">New Company</h1>

    <div class="text-end">
        <a href="{{ route('companies.index') }}" class="btn btn-warning">Cancel and Back To Companies</a>
    </div>
    <br>


    <div class="row">
        <div class="offset-3 col-6">

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Add a New Company
                </div>

                <div class="card-body">
                    <form method="POST"
                          enctype="multipart/form-data"
                          action="{{ route('companies.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="name" class="col-form-label">Company Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{ old('name') }}"
                                       id="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>


                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="logo" class="col-form-label">Logo</label>
                            </div>
                            <div class="col-9">
                                <input type="file"
                                       class="form-control"
                                       name="logo"
                                       value="{{ old('logo') }}"
                                       id="logo">
                                @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="row md-3">
                            <div class="col-12">
                                <input type="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>


    @endsection
