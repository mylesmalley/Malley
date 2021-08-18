@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">{{ $user->first_name }} {{ $user->last_name }}</h1>

    <div class="text-end">
        <a href="{{ route('users.index') }}" class="btn btn-secondary text-end">Back to Index</a>
        <a href="{{ route('companies.show', [ $user->company_id ]) }}" class="btn btn-secondary text-end">Back to {{ $company->name }}</a>
    </div>
    <br>

    <div class="row">
        <div class="col-6">
            @livewire('usermanagement::user-details', [ 'user'=> $user])
        </div>

        <div class="col-6">
            @livewire('usermanagement::user-roles', [ 'user'=> $user])
        </div>
    </div>


@endsection
