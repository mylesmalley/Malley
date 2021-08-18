@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>


                New Option for {{ $basevan->name }}
        </h1>
    </div>

    <div class="card  bg-warning">
        <div class="card-body">
            Are you sure you want to create a new option rather than a revision of an existing one?
        </div>
    </div>


    @includeIf('app.components.errors')

    <div class="panel-body">



        <form
            method="POST"
            action="{{  url('/index/basevan/'. $basevan->id) }}">


            {{ csrf_field() }}

            <input type="hidden"
                   name="revision"
                   id="revision"
                   value="1">
            <input type="hidden"
                   name="base_van_id"
                   id="base_van_id"
                   value="{{ $basevan->id }}">
            <input type="hidden"
                   name="user_id"
                   id="user_id"
                   value="{{ Auth::user()->id }}">

            <input type="hidden"
                   id="engineering_notes"
                   name="engineering_notes"
                   value="Newly created option">

            <input type="hidden"
                   id="option_name"
                   name="option_name"
                   value="Newly created option">

            <input type="hidden"
                   id="option_price_tier_1"
                   name="option_price_tier_1"
                   value="0">



            <h3>About</h3>
            <table class="table table-striped">

                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>
                            <div class="row">
                                <div class="col-3">
                                    Prefix
                                    <input type="text"
                                           class="form-control"
                                           id="namePrefix"
                                           name="namePrefix"
                                           aria-label=""
                                           readonly
                                           value="{{ old('namePrefix')  ?? $basevan->option_prefix }}">

                                </div>

                                <div class="col-3">
                                    Number
                                    <input type="text"
                                           class="form-control"
                                           aria-label=""
                                           name="nameIdentifier"
                                           id="nameIdentifier"
                                           value="{{ old('nameIdentifier') ?? "" }}">
                                </div>

                                <div class="col-3">
                                    Iteration
                                    <input type="text"
                                           class="form-control"
                                           name="nameRevision"
                                           aria-label=""
                                           id="nameRevision"
                                           value="{{ old('nameRevision')  ?? "001" }}">



                                </div>
                            </div>




                        </td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td><input class="form-control"
                                   name="option_description"
                                   id="option_description"
                                   aria-label="Option Description"
                                   type="text"
                                   value="{{ old('option_description') }}"
                            />
                        </td>
                    </tr>



                </tbody>

            </table>






            <h3>Inventory</h3>
            <table class="table table-striped">

                <tbody>
                <tr>
                    <td>This option will have components?</td>
                    <td>
                        <select name="no_components"
                                aria-label=""
                                id="no_components"
                                class="form-control">
                            @foreach([ 0=>"Yes, should have components", 1 =>'No, will not have components' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('no_components') == $key  )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>


                    <tr>
                        <td>Syspro Phantom</td>
                        <td>
                            GENERATED AUTOMATICALLy
{{--                            <input class="form-control"--}}
{{--                                   name="option_syspro_phantom"--}}
{{--                                   id="option_syspro_phantom"--}}
{{--                                   aria-label="Option Syspro Phantom"--}}
{{--                                   type="text"--}}
{{--                                   value="{{ old('option_syspro_phantom') }}"--}}
{{--                            />--}}
                        </td>
                    </tr>


                    <tr>
                        <td>Has Long Lead Time?</td>
                        <td>
                            <select name="option_long_lead_time"
                                    aria-label=""
                                    id="option_long_lead_time"
                                    class="form-control">
                                @foreach([ 0 =>'No', 1=>"Yes"] as $key => $value)
                                    <option value="{{ $key }}"
                                            @if ( old('option_long_lead_time' ) === $key  )
                                            selected
                                            @endif
                                    >{{ $value }}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>




                <tr>
                    <td>Labour Quantity (hrs)</td>
                    <td><input class="form-control"
                               name="option_labour_qty"
                               id="option_labour_qty"
                               aria-label="Option option_labour_qty"
                               type="text"
                               value="{{ old('option_labour_qty',0) }}"
                        />
                    </td>
                </tr>

                <tr>
                    <td>Labour Quantity (Cost)</td>
                    <td><input class="form-control"
                               name="option_labour_cost"
                               id="option_labour_cost"
                               aria-label="option_labour_cost"
                               type="text"
                               value="{{ old('option_labour_cost', 25) }}"
                        />
                    </td>
                </tr>


                </tbody>
            </table>

<br>

            <h3>Sales &amp; Pricing</h3>
            <table class="table table-striped">

                <tbody>


                <tr>
                    <td>Will this option have pricing?</td>
                    <td>
                        <select name="has_pricing"
                                aria-label=""
                                id="has_pricing"
                                class="form-control">
                            @foreach([ 1=>"Yes, it should have pricing", 0 =>'No, this option will not have pricing' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('has_pricing') === $key   )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>



                <tr>
                    <td>Should this option appear on quotes?</td>
                    <td>
                        <select name="option_show_on_quote"
                                aria-label=""
                                id="option_show_on_quote"
                                class="form-control">
                            @foreach([ 1=>"Yes", 0 =>'No' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('option_show_on_quote') === $key   )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>


                    <tr>
                        <td>Dealer Price</td>
                        <td><input class="form-control"
                                   name="option_price_tier_2"
                                   id="option_price_tier_2"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_tier_2', 0 ) }}"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td>Dealer Price Offset</td>
                        <td><input class="form-control"
                                   name="option_price_dealer_offset"
                                   id="option_price_dealer_offset"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_dealer_offset', 0) }}"
                            />
                        </td>
                    </tr>

                    <tr>
                        <td>MSRP Price</td>
                        <td><input class="form-control"
                                   name="option_price_tier_3"
                                   id="option_price_tier_3"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_tier_3', 0) }}"
                            />
                        </td>
                    </tr>
                    <tr>
                        <td>MSRP Price Offset</td>
                        <td><input class="form-control"
                                   name="option_price_msrp_offset"
                                   id="option_price_msrp_offset"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_msrp_offset', 0 ) }}"
                            />
                        </td>
                    </tr>

                </tbody>
            </table>


            <br>


            <h3>Drawing Packages</h3>
            <table class="table table-striped">

                <tbody>


                <tr>
                    <td>Will this option have appear in drawing packages?</td>
                    <td>
                        <select name="show_on_templates"
                                aria-label=""
                                id="show_on_templates"
                                class="form-control">
                            @foreach([ 1=>"Yes, it should appear in drawing pacakges", 0 =>'No, this option will not appear in drawing packages' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('show_on_templates') == $key   )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>

                </tbody>
            </table>



            <h3>Forms </h3>
            <table class="table table-striped">

                <tbody>


                <tr>
                    <td>Should this option appear on forms? This should be the case but may not be if the option is always on or is a customer-specific option we don't want widely available.</td>

                    <td>
                        <select name="show_on_forms"
                                aria-label=""
                                id="show_on_forms"
                                class="form-control">
                            @foreach([ 1=>"Yes, it is expected to appear in forms",
                                        0 =>"No, this option won't be used in forms" ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('show_on_forms') == $key   )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>

                </tbody>
            </table>



            <p>Creating a new option will:            </p>

            <ul>
                    <li>Attempt to pull components from Syspro if a valid phantom was provided</li>
                    <li>Update all active Blueprints.</li>
            </ul>
            <input type="submit" value="Create new Option" class="btn btn-primary">

    </form>



    </div>
            @endsection

@section('javascript')

@endsection
