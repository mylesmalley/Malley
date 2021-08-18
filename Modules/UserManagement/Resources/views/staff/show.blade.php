@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">{{ $user->first_name }} {{ $user->last_name }}</h1>

    <div class="text-end">
        <a href="{{ route('staff.index') }}" class="btn btn-secondary text-end">Back to Staff</a>
    </div>
    <br>

    <div class="row">
        <div class="col-6 offset-3">
            @livewire('usermanagement::staff-details', [ 'user'=> $user])
        </div>
    </div>


    <br>

    <div class="row">
        <div class="col-6 offset-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    @if( $user->is_enabled )
                        <span class="text-success">This user's account is enabled. They can sign on and clock in to labour.</span>
                    @else
                        <span class="text-danger">This user's account is locked. They can't access any part of the site.</span>
                    @endif
                    <form method="POST" action="{{ route('staff.toggle', [ $user->id ]) }}">
                        @method('PATCH')
                        @csrf
                        @if( $user->is_enabled )
                            <input type="submit" class="btn btn-danger" value="LOCK ACCOUNT">
                        @else
                            <input type="submit" class="btn btn-secondary" value="(RE-) ENABLE ACCOUNT">
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
