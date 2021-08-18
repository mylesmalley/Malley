@extends('usermanagement::layouts.master')

@section('content')

<h1 class="text-center">All Regular Users</h1>

<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        All Users
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <TH>ID</TH>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Roles</th>
                <th>Account Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id  }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>
                        <a href="{{ route('companies.show', [$user->company_id ]) }}">
                            {{ $user->company->name }}
                        </a>
                    </td>
                    <td>
                        <ul>
                        @foreach( $user->getRoleNames() as $role )
                                <li>{{ $role }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($user->is_enabled)
                            <span class="text-success"> ENABLED </span>
                        @else
                            <span class="text-danger"> LOCKED </span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                            href="{{ route('users.show', [ $user->id ]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">

    {{ $users->links() }}
    </div>

</div>

@endsection
