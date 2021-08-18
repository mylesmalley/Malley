@extends('vehicles::layout')


@php


    $targets = [
        "work_order" => "Work Orders",
        "vin"   => "VINs",
        "customer_name" => "Customer",
        "dealer" => "Dealer Name",
     //   "flowmeter" => "Flow Meter Serial(s)",
   //     "qstraint" => "Q'Straint Serial(s)",
        "malley_number" => "A#, MO#, ABLS# etc",
        "customer_number" => "Customer's Number",
      //  "refurb_number" => "Customer's Number",

    ];
@endphp

@section('content')

            <h1 class="text-center">Search   </h1>


    @includeIf('vehicles::errors')

    <div class="row">
        <div class="col-12">

            <div class="card border-primary">
                <div class="card-header bg-primary text-center">

                    <form method="POST"
                          action="{{ '/vehicles/search' }}">
                        {{ csrf_field() }}

                        <div class="input-group input-group-lg">

                            <span class="input-group-text">Search</span>

                            <select class="custom-select"
                                    id="target"
                                    name="target"
                                    aria-label="">
                                @foreach( $targets as $key => $value )

                                    <option
                                        {{ $request->target === $key || old('target') === $key ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>

                            <span class="input-group-text">for</span>



                            <input type="text"
                                   class="form-control"
                                   id="term"
                                   name="term"
                                   value="{{ old('term') ?? $request->term ?? "" }}"
                                   aria-label="">

                            <div class="input-group-append">
                                <input
                                    class="btn btn-dark"
                                    type="submit"
                                    value="Search"
                                >
                            </div>

                        </div>


                    </form>



                </div>
                <table class="table table-striped table-sm table-hover">
                    <thead>
                    <tr>
                        <th> Work Order </th>
                        <th> Customer </th>
                        @if ( $request->target === 'dealer')
                            <th> Dealer </th>

                        @endif
                        {{--                @if (in_array( 'name', $result_columns))--}}

                        {{--                    <th> Dealer </th>--}}
                        {{--                @endif--}}
                        <th> VIN </th>
                        <th> Malley # </th>
                        <th> Vehicle </th>
                        <th> OEM Dealer</th>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse( $results as $v )
                        {{--                <tr onclick="window.location = '{{ url('/vehicles/'.$v->id) }}'; ">--}}
                        <tr>
                            <td> {{ $v->work_order ?? ''  }} </td>
                            <td> {{ $v->customer_name  ?? '' }} </td>
                            @if ( $request->target === 'dealer')
                                <td> {{ $v->name  ?? ''  }} </td>

                            @endif
                            <td> {{ $v->vin   ?? '' }} </td>
                            <td> {{ $v->malley_number  ?? '' }} </td>
                            <td> {{ $v->make .' '.$v->model.' '.$v->year }} </td>
                            <td> {{ $v->oem_dealer ?? '' }} </td>
                            <td>
                                <a href="{{ url('/vehicles/'.$v->id) }}" class="btn btn-sm btn-success">Go</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                No matches
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>



        </div>
    </div>
{{--    @php--}}
{{--        $result_columns= collect([]);--}}
{{--            if(!empty($results)){--}}
{{--                 $result_columns = collect($results->first())->keys();--}}
{{--            }--}}

{{--    dd( $result_columns);--}}
{{--    @endphp--}}






@endsection
