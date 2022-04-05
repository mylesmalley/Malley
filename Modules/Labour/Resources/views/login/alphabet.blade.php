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
                        <h1>First Letter of Last Name</h1>
                    </div>
                    <div class="card-body ">

                        @foreach( range("A", "Z") as $letter)
                            <a class="btn btn-secondary btn-lg m-1"
                               href="{{ route('labour.login.letter', [ $letter ]) }}">
                                {{ $letter }}
                            </a>

                        @endforeach
                    </div>

                </div>
            </div>


        </div>

    </div>
    
@endsection
