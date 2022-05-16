@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Bodyguard Kit Index</h1>
    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card border-primary">
                 <div class="card-body">
                     <form class="row row-cols-lg-auto g-3 align-items-center"
                          action="{{ route('bg.kits.home') }}"
                          method="GET">

                        @csrf

                         <div class="col-2">
                             <label for="chassis"
                                    class="form-label">
                                 Chassis & Wheelbase</label>
                             <select class="form-control"
                                     name="chassis"
                                     id="chassis">
                                    <option value="ALL">All</option>
                                 @foreach( $wheelbases as $van => $options )
                                     <optgroup label="{{ $van }}">
                                         @foreach( $options as $key => $desc)
                                             <option
                                                     {{ request()->input('chassis') === $key ? " selected " : ""   }}
                                                     value="{{ $key }}">{{ $desc  }}</option>
                                         @endforeach
                                     </optgroup>

                                 @endforeach
                             </select>
                         </div>



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
                            <td>{{ $result->part_number }}</td>
                            <td>{{ $result->description }}</td>
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