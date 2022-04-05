@extends('labour::layouts.master')

@section('content')
    <div class="container">

        <div class="row g-7" style="padding-top:20%;">

            <div class="col-12 text-center">

                <h1 class="display-1">Labour Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h1>Hello, {{ $user->first_name }}

                            <a href="{{ route('labour.login.letter', [ substr($user->last_name, 0,1)]) }}"
                               class="btn btn-light float-end">Go Back</a>
                        </h1>

                    </div>

        <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('labour.submitLogin') }}">
                    {{ csrf_field() }}

                    <input type="hidden" id="id" name="id" value="{{ $user->id }}" >

                    <input type="Password"
                           aria-label="Password"
                           id="password"
                           name="password"
                           autocomplete="off"
                           class="form-control"
                           value=""
                          >

                    <input type="submit"
                           dusk="submitLoginFormButton"
                           class="btn btn-lg btn-success" value="Log In">

                </form>


        </div>



    </div>

</div>
            @endsection