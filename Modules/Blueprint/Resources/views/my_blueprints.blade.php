@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $title  ?? "My Blueprints"}}</h1>
        </div>
    </div>

    <div class="card border-primary" >
        <div class="card-header text-white">

        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Platform</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>

                @forelse( $blueprints as $blueprint )
                    <tr onclick="window.location = '{{ route('blueprint_home', [ $blueprint->id ]) }}'">
                        <td>B-{{ $blueprint->id }}</td>
                        <td>
                            <span class="fw-bolder text-primary">{{ $blueprint->name }}</span> <br>
                            <span class="fw-light">{{ $blueprint->description }}</span>
                        </td>
                        <td>{{ $blueprint->platform->name }}</td>
                        <td>{{ $blueprint->updated_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"> You haven't created a Blueprint yet! Get started by clicking <a href="{{ route('blueprint_create') }}">Here</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="card-footer text-center">
            {{ $blueprints->links() }}

        </div>
    </div>

@endsection
