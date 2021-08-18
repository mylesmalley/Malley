@extends('usermanagement::layouts.master')

@section('content')

<h1 class="text-center">All Staff</h1>

<div class="text-end">
    <a href="{{ route('staff.create') }}" class="btn btn-success">Add Staff</a>
</div>

<br>
<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        All Staff
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <TH>ID</TH>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
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
                    <td>{{ $user->department->name ?? "Not Set" }}</td>
                    <td>
                        @if ($user->is_enabled)
                            <span class="text-success"> ENABLED </span>
                        @else
                            <span class="text-danger"> LOCKED </span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-warning"
                           href="{{ route('staff.reset_password_form', [ $user->id ]) }}">Reset Password</a>
                        <a class="btn btn-sm btn-secondary"
                            href="{{ route('staff.show', [ $user->id ]) }}">Edit</a>
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
