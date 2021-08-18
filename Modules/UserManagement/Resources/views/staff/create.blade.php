@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">New Staff</h1>

    <div class="text-end">
        <a href="{{ route('staff.index') }}" class="btn btn-warning">Cancel and Back To Staff</a>
    </div>
    <br>


    <div class="row">
        <div class="offset-3 col-6">

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Add a new Staff Account
                </div>

                <div class="card-body">
                    <form method="POST"
                          action="{{ route('staff.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="first_name" class="col-form-label">First Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                       class="form-control"
                                       name="first_name"
                                       value="{{ old('first_name') }}"
                                       id="first_name">
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="last_name" class="col-form-label">Last Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                       class="form-control"
                                       name="last_name"
                                       value="{{ old('last_name') }}"
                                       id="last_name">
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="department_id" class="col-form-label">Department</label>
                            </div>
                            <div class="col-9">
                                <select
                                    id="department_id"
                                    name="department_id"
                                    class="form-control">
                                    @foreach( \App\Models\Department::all() as $department )
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>


                        </div>


                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="password" class="col-form-label">Password</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                       class="form-control"
                                       name="password"
                                       value="{{ old('password', "Welcome".rand(22,99)) }}"
                                       id="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>



                        <div class="row md-3">
                            <div class="col-12">
                                <input type="submit"
                                       value="Create Account"
                                       class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>



        </div>


    @endsection
