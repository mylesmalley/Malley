@extends('index::app.main')


@section("content")
    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

        {{--        @includeIf('index::options.components.partials.revisionForm')--}}

        <div class="input-group">
            <a href="{{ url('/index/option/'.$option->id. '/home') }}" class="btn btn-dark btn-lg">Back to Option</a>
        </div>

        {{--        <div class="input-group">--}}
        {{--            <a href="{{ url('/index/basevan/'.$option->base_van_id) }}" class="btn btn-dark btn-lg">Back To Index</a>--}}
        {{--        </div>--}}

    </div>

    <div class="row">
        <div class="col-12">
            <h1>{{ $option->fullName }} Pricing</h1>
            <h3 class="text-secondary">{{ $option->option_description }}</h3>
        </div>
    </div>


    @if ($message = \Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = \Session::get('error'))
        <div class="alert alert-danger  alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @includeIf('app.components.errors')


    <form method="POST" action="{{ route('option_revision_from_pricing', [$option]) }}">
        {{ csrf_field() }}


        <input type="hidden" name="option_name" value="{{ $option->option_name }}">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Pricing Update Form
                </div>

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Old Price</th>
                            <th>New Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Dealer Price</td>
                            <td>$ {{ number_format( $option->option_price_tier_2,2) }}</td>
                            <td><input class="form-control"
                                       name="option_price_tier_2"
                                       id="option_price_tier_2"
                                       aria-label=""
                                       type="text"
                                       value="{{ old('option_price_tier_2', number_format( $option->option_price_tier_2,2,'.','') ) }}"
                                />
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>Dealer Price Offset</td>--}}
{{--                            <td>$ {{ number_format( $option->option_price_dealer_offset ,2) }}</td>--}}
{{--                            <td><input class="form-control"--}}
{{--                                       name="option_price_dealer_offset"--}}
{{--                                       id="option_price_dealer_offset"--}}
{{--                                       aria-label=""--}}
{{--                                       type="text"--}}
{{--                                       value="{{ old('option_price_dealer_offset', number_format( $option->option_price_dealer_offset,2, '.','') ) }}"--}}
{{--                                />--}}
{{--                            </td>--}}
{{--                        </tr>--}}

                        <tr>
                            <td>MSRP Price</td>
                            <td>$ {{ number_format( $option->option_price_tier_3,2) }}</td>
                            <td><input class="form-control"
                                       name="option_price_tier_3"
                                       id="option_price_tier_3"
                                       aria-label=""
                                       type="text"
                                       value="{{ old('option_price_tier_3', number_format( $option->option_price_tier_3,2, '.','') ) }}"
                                />
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>MSRP Price Offset</td>--}}
{{--                            <td>$ {{ number_format( $option->option_price_msrp_offset ,2) }}</td>--}}
{{--                            <td><input class="form-control"--}}
{{--                                       name="option_price_msrp_offset"--}}
{{--                                       id="option_price_msrp_offset"--}}
{{--                                       aria-label=""--}}
{{--                                       type="text"--}}
{{--                                       value="{{ old('option_price_msrp_offset', number_format( $option->option_price_msrp_offset,2,'.','') ) }}"--}}
{{--                                />--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                    </tbody>
                </table>
            </div>

            <div class="card-footer ">
                <label for="engineering_notes">Reason for change</label>
                <input type="text" name="engineering_notes"
                       id="engineering_notes"
                       placeholder="reason for this update"
                       value="{{ old('engineering_notes', "Updating pricing ".date('Y-m-d')) }}"
                       class="form-control" />

                <input type="submit" class="btn btn-primary" value="Save New Pricing">
            </div>
        </div>


    </div>

    </form>



@endsection
