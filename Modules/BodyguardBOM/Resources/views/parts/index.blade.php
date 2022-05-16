@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Bodyguard Kit Index</h1>
    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="{{ route('labour.management.home', ['active_tab'=>'all']) }}"
                               class="nav-link {{ $active_tab === 'all' ? 'active' : 'bg-secondary text-white' }}"
                            >All Staff By Date</a>
                        </li>
                    </ul>
                </div>
                 <div class="card-body">


                        @if ( $active_tab === 'all' )

                            <form class="row row-cols-lg-auto g-3 align-items-center"
                                  action="{{ route('labour.management.home') }}"
                                  method="GET">
                                <input type="hidden" name="active_tab" value="all">
                                @csrf

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Go</button>
                                </div>
                            </form>
                        @endif
                    </div>
            </div>
        </div>
    </div>

@endsection