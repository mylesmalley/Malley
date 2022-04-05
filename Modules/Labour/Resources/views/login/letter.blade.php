@extends('labour::layouts.master')

@section('content')
    <div class="container">

        <div class="row g-7" style="">

            <div class="col-12 text-center">

                <h1 class="display-1">Labour Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        <h1>Choose your name
                            <a href="{{ route('labour.login.alphabet') }}"
                               class="btn btn-light float-end">Go Back</a>
                        </h1>

                    </div>
                    <div class="card-body">

                        @foreach( $users as $user )
                            <a class="btn btn-secondary btn-lg m-1"
                               href="{{ route('labour.login', [ $user ]) }}">
                                {{ $user->first_name ?? "FIRST" }} {{ $user->last_name ?? "LAST" }}
                            </a>

                        @endforeach
                    </div>

                </div>
            </div>


        </div>

    </div>
    
@endsection
