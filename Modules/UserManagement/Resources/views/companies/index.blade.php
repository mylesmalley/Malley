@extends('usermanagement::layouts.master')

@section('content')

<h1 class="text-center">Companies</h1>

<div class="text-end">
    <a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a>
</div>

<br>

<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        All Companies
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <TH>ID</TH>
                <th>Name</th>
                <th>Logo</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach( $companies as $company )
                <tr>
                    <td>{{ $company->id  }}</td>
                    <td>{{ $company->name }}</td>
                    <td>
                        @if ($company->hasMedia('logo'))
                            <img alt="Logo"
                                 width="200"
                                 src="{{ $company->getMedia('logo')->first()->cdnURL() }}">
                            @endif
                    </td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                            href="{{ route('companies.show', [ $company->id ]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">

    {{ $companies->links() }}
    </div>

</div>

@endsection
