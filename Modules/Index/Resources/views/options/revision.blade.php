@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>


                New Revision for {{ $option->option_name }}
        </h1>
    </div>

    @includeIf('app.components.errors')

    <div class="panel-body">


        <form
            method="POST"
            action="{{  url('/index/option/revision') }}">


            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $option->id }}" />
            <input type="hidden" name="revision" id="revision" value="{{ $option->revision + 1 }}">
            <input type="hidden" name="option_name" id="option_name" value="{{ $option->option_name }}">
            <input type="hidden" name="base_van_id" id="base_van_id" value="{{ $option->base_van_id }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">


            <h3>About</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Current</th>
                        <th>New Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td>{{ $option->option_name }}</td>
                        <td>{{ $option->option_name }}</td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{{ $option->option_description }}</td>
                        <td><input class="form-control"
                                   name="option_description"
                                   id="option_description"
                                   aria-label="Option Description"
                                   type="text"
                                   value="{{ old('option_description', $option->option_description) }}"
                            />
                        </td>
                    </tr>



                </tbody>

            </table>






            <h3>Inventory</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Current</th>
                    <th>New Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>This option will have components?</td>
                    <td>{{ !$option->no_components ? "Yes, should have components" : "No, will not have components" }}</td>
                    <td>
                        <select name="no_components"
                                aria-label=""
                                id="no_components"
                                class="form-control">
                            @foreach([ 0=>"Yes, should have components", 1 =>'No, will not have components' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('no_components', $option->no_components) == $key ||
                                          ( $option && $option->no_components == $key )  )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>


                    <tr>
                        <td>Syspro Phantom</td>
                        <td>{{ $option->option_syspro_phantom }}</td>
                        <td>
                            GENERATED AUTOMATICALLY
{{--                            <input class="form-control"--}}
{{--                                   name="option_syspro_phantom"--}}
{{--                                   id="option_syspro_phantom"--}}
{{--                                   aria-label="Option Syspro Phantom"--}}
{{--                                   type="text"--}}
{{--                                   value="{{ old('option_syspro_phantom', $option->option_syspro_phantom) }}"--}}
{{--                            />--}}
                        </td>
                    </tr>


                    <tr>
                        <td>Has Long Lead Time?</td>
                        <td>{{ $option->option_long_lead_time ? "Yes" : "No" }}</td>
                        <td>
                            <select name="option_long_lead_time"
                                    aria-label=""
                                    id="option_long_lead_time"
                                    class="form-control">
                                @foreach([ 0 =>'No', 1=>"Yes"] as $key => $value)
                                    <option value="{{ $key }}"
                                            @if ( old('option_long_lead_time', $option->option_long_lead_tim) == $key ||
                                              ( $option && $option->option_long_lead_time == $key )  )
                                            selected
                                            @endif
                                    >{{ $value }}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>




                <tr>
                    <td>Labour Quantity (hrs)</td>
                    <td>{{ $option->option_labour_qty }}</td>
                    <td><input class="form-control"
                               name="option_labour_qty"
                               id="option_labour_qty"
                               aria-label="Option option_labour_qty"
                               type="text"
                               value="{{ old('option_labour_qty', $option->option_labour_qty) }}"
                        />
                    </td>
                </tr>

                <tr>
                    <td>Labour Quantity (Cost)</td>
                    <td>{{ $option->option_labour_cost }}</td>
                    <td><input class="form-control"
                               name="option_labour_cost"
                               id="option_labour_cost"
                               aria-label="option_labour_cost"
                               type="text"
                               value="{{ old('option_labour_cost', $option->option_labour_cost) }}"
                        />
                    </td>
                </tr>


                </tbody>
            </table>

<br>

            <h3>Sales &amp; Pricing</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Field</th>
                    <th>Current</th>
                    <th>New Value</th>
                </tr>
                </thead>
                <tbody>


                <tr>
                    <td>Will this option have pricing?</td>
                    <td>{{ $option->has_pricing ? "Yes, it should have pricing" : "No, this option will not have pricing" }}</td>
                    <td>
                        <select name="has_pricing"
                                aria-label=""
                                id="has_pricing"
                                class="form-control">
                            @foreach([ 1=>"Yes, it should have pricing", 0 =>'No, this option will not have pricing' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('has_pricing', $option->has_pricing) == $key ||
                                          ( $option && $option->has_pricing == $key )  )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>



                <tr>
                    <td>Should this option appear on quotes?</td>
                    <td>{{ $option->option_show_on_quote ? "Yes" : "No" }}</td>
                    <td>
                        <select name="option_show_on_quote"
                                aria-label=""
                                id="option_show_on_quote"
                                class="form-control">
                            @foreach([ 1=>"Yes", 0 =>'No' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('option_show_on_quote', $option->option_show_on_quote) == $key ||
                                          ( $option && $option->option_show_on_quote == $key )  )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>


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
                    <tr>
                        <td>Dealer Price Offset</td>
                        <td>$ {{ number_format( $option->option_price_dealer_offset ,2) }}</td>
                        <td><input class="form-control"
                                   name="option_price_dealer_offset"
                                   id="option_price_dealer_offset"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_dealer_offset', number_format( $option->option_price_dealer_offset,2, '.','') ) }}"
                            />
                        </td>
                    </tr>

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
                    <tr>
                        <td>MSRP Price Offset</td>
                        <td>$ {{ number_format( $option->option_price_msrp_offset ,2) }}</td>
                        <td><input class="form-control"
                                   name="option_price_msrp_offset"
                                   id="option_price_msrp_offset"
                                   aria-label=""
                                   type="text"
                                   value="{{ old('option_price_msrp_offset', number_format( $option->option_price_msrp_offset,2,'.','') ) }}"
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
                    <td>Will this option appear in drawing packages?</td>
                    <td>{{ $option->show_on_templates ? "Yes" : "No" }}</td>

                    <td>
                        <select name="show_on_templates"
                                aria-label=""
                                id="show_on_templates"
                                class="form-control">
                            @foreach([ 1=>"Yes, it should appear in drawing pacakges", 0 =>'No, this option will not appear in drawing packages' ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('show_on_templates', $option->show_on_templates) == $key   )
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
                    <td>{{ $option->show_on_forms ? "Yes, it is expected to appear in forms"
                            :"No, this option won't be used in forms" }}</td>

                    <td>
                        <select name="show_on_forms"
                                aria-label=""
                                id="show_on_forms"
                                class="form-control">
                            @foreach([ 1=>"Yes, it is expected to appear in forms",
                                        0 =>"No, this option won't be used in forms" ] as $key => $value)
                                <option value="{{ $key }}"
                                        @if ( old('show_on_forms',  $option->show_on_forms) == $key   )
                                        selected
                                        @endif
                                >{{ $value }}</option>
                            @endforeach
                        </select>

                    </td>
                </tr>

                </tbody>
            </table>



            <br>

            <h3>Reason for Change</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Notes on Last Revision</th>
                    <th>Reason for new Revision</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $option->engineering_notes }}</td>

                    <td>
                        <textarea required
                                  id="engineering_notes"
                                  name="engineering_notes"
                                  class="form-control"
                                  aria-label="">{{ old('engineering_notes') }}</textarea>

                    </td>
                </tr>



                </tbody>

            </table>





            <p>Creating a new revision will:            </p>

            <ul>
                    <li>Mark the old revision obsolete</li>
                    <li>Attempt to pull components from Syspro if a valid phantom was provided</li>
                    <li>Copy rules and update references to match the current revision.</li>
                    <li>Duplicate photos and drawings and update.</li>
                    <li>Update forms to reference the new revision.</li>
                    <li>Update drawing packages to the new revision.</li>
                    <li>Update all Blueparints that aren't locked to have the new revision.</li>
                    <li>Turn off the old rev and turn on the new rev where appropriate on Blueprint.</li>
            </ul>
            <input type="submit" value="Create new Revision" class="btn btn-primary">

    </form>



    </div>
            @endsection

@section('javascript')

@endsection
