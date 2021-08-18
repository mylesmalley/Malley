@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">{{ $user->first_name }} {{ $user->last_name }}</h1>

    <div class="text-end">
        <a href="{{ route('staff.index') }}" class="btn btn-warning">Cancel and Back To Staff</a>
    </div>
    <br>


    <div class="row">
        <div class="offset-3 col-6">

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Password Reset
                </div>

                <div class="card-body">
                    <form method="POST"
                          action="{{ route('staff.submit_password_reset', [$user->id]) }}">
                        @method('PATCH')
                        @csrf

                        <div class="row mb-3">
                            <div class="col-3">
                                <label for="password" class="col-form-label">New Password</label>
                            </div>
                            <div class="col-9">
                                <input type="text"
                                       class="form-control"
                                       name="password"
                                       value="{{ old('password', 'Password'.rand(10,99)) }}"
                                       id="password">
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                        </div>



                        <div class="row md-3">
                            <div class="col-12">
                                <input type="submit"
                                       value="Reset {{ $user->first_name }}'s Password"
                                       class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>Password needs to be at least 6 characters long. Make note of this new password before submitting the form as you can't get it back. If you or they forget, it will need to be reset again.</p>

                </div>

            </div>




        </div>


    @endsection
