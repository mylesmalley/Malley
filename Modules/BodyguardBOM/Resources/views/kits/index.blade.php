@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Bodyguard Kit Index</h1>
    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                 <div class="card-body">
                     <form class="row row-cols-lg-auto g-3 align-items-center"
                          action="{{ route('labour.management.home') }}"
                          method="GET">
                        <input type="hidden" name="active_tab" value="all">
                        @csrf
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Go</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <table class="table table-hover table-striped">
                <tbody>
                    @forelse( $results as $result )
                        <tr>
                            <td>{{ $result->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1000">No records matching</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection