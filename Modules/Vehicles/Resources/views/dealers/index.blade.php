@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">Dealers
                <a href="{{ url('vehicles/dealers/create') }}" is=""
                    class="btn btn-primary">Add</a>
            </h1>
        </div>
    </div>

    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th> Dealer </th>

        </tr>
        </thead>
        <tbody>

        @forelse( $dealers as $dealer )

            <tr>

                <td>
                    {{ $dealer->name }}
                </td>

            </tr>


        @empty
            <tr>
                <td colspan="3"> Nothing </td>
            </tr>
        @endforelse
        </tbody>

    </table>



@endsection
