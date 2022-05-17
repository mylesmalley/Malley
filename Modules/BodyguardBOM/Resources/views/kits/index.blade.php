@extends('bodyguardbom::layouts.master')

@section('content')
    <h1>Bodyguard Kit Index</h1>
    @includeIf('app.components.errors')

    <div class="row">
        <div class="col-12">
            <div class="card border-primary">



                 <div class="card-body">
                     <form class="row row-cols-lg-auto g-3 align-items-end"
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


                         <div class="col-2">
                             <label for="roof_height"
                                    class="form-label">
                                 Roof Height</label>
                             <select class="form-control"
                                     name="roof_height"
                                     id="roof_height">
                                 <option value="ALL">All</option>
                                 @foreach( $roof_heights as $key => $desc)
                                     <option
                                         {{ request()->input('roof_height') === $key ? " selected " : ""   }}
                                         value="{{ $key }}">{{ $desc  }}</option>
                                 @endforeach
                             </select>
                         </div>


                         <div class="col-3">
                             <label for="roof_height"
                                    class="form-label">
                                 Kit Type</label>
                             <select class="form-control"
                                     name="type"
                                     id="type">
                                 <option value="ALL">All</option>
                                 @foreach( $kit_codes as $key => $val)
                                     <option
                                             {{ request()->input('type') === $key ? " selected " : ""   }}
                                             value="{{ $key }}">{{ $val['desc']  }}</option>
                                 @endforeach
                             </select>
                         </div>





                         <div class="col-2">
                             <label for="colour"
                                    class="form-label">
                                 Colour</label>
                             <select class="form-control"
                                     name="colour"
                                     id="colour">
                                 <option value="ALL">All</option>
                                 @foreach( $colours as $key => $desc)
                                     <option
                                             {{ request()->input('colour') === $key ? " selected " : ""   }}
                                             value="{{ $key }}">{{ $desc  }}</option>
                                 @endforeach
                             </select>
                         </div>





                        <div class="col-2 " >
                            <button
                                    id="go"
                                    name="go"
                                    type="submit"
                                    class="btn btn-primary">Go</button>
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