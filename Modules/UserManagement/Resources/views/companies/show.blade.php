@extends('usermanagement::layouts.master')

@section('content')

    <h1 class="text-center">
        @if ( $company->hasMedia('logo'))
        <img alt="Logo"
             width="200"
             src="{{ $company->getMedia('logo')->first()->cdnURL() }}"><br>
        @endif
        {{ $company->name }} Users</h1>

    <div class="text-end">
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back To Companies</a>
    </div>
    <br>


    <div class="row">
        <div class="col-6">



            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    Active Users
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <TH>ID</TH>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Account Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $active as $user )
                        <tr>
                            <td>{{ $user->id  }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>
                                <a class="btn btn-sm btn-secondary"
                                   href="{{ route('users.show', [ $user->id ]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>



        </div>


        <div class="col-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Locked Users
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <TH>ID</TH>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Account Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $locked as $user )
                        <tr>
                            <td>{{ $user->id  }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>
                                <a class="btn btn-sm btn-secondary"
                                   href="{{ route('users.show', [ $user->id ]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>

        </div>
    </div>

    @endsection
