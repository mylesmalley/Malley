@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>{{ $part->part_number }}</h1>
    @includeIf('app.components.errors')
    <ul>


    <li class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">

                </div>
                <table class="table table-striped table-hover">
                    @foreach( $categories as $category )
                        <tr onclick="location.href = '{{ route('bg.categories.show', [$category])}}'">
                            <td>
                                {{ $category->name }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </li>

    </ul>

@endsection