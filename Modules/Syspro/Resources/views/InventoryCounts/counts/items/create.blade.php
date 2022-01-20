@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="uk-heading-medium">Add Custom / Blank Ticket</h1>

    @includeIf('syspro::InventoryCounts.errors')

<div class="container">

    <form class="form"
          action="{{ route('inventory_counts.store_custom_item', [$inventory]) }}"
          method="POST">
        {{ csrf_field() }}

    <div class="row">
        <label for="stock_code"
               class="col-sm-2 col-form-label">Stock Code</label>
        <div class="col-3">
            <input type="text"
                   class="form-control "
                   id="stock_code"
                   required
                   placeholder="Stock Code"
                   value="{{ app('request')->input('stock_code') ?? old('stock_code') }}"
            >
        </div>
    </div>

    <div class="row">
        <label for="description_1"
               class="col-sm-2 col-form-label">Description</label>
        <div class="col-5">
            <input type="text"
                   class="form-control "
                   id="description_1"
                   required
                   placeholder="Description"
                   value="{{ old('description_1') }}">
        </div>
    </div>

    <div class="row">
        <label for="description_2"
               class="col-sm-2 col-form-label"></label>
        <div class="col-5">
            <input type="text"
                   class="form-control "
                   id="description_2"
                   placeholder="Description line 2"
                   value="{{ old('description_2') }}">
        </div>
    </div>


        <div class="row">
            <div class="col-2">
                <label for="unit_of_measure">Unit of Measure</label>

            </div>
            <div class="col-3">
                <select name="unit_of_measure"
                        class="form-control"
                        id="unit_of_measure">
                    @foreach([
                            "EA" => "EACH",
                        "BAG" => "PER BAG",
                        "BOT" => "BOTTLE",
                        "BOX" => "PER BOX",
                        "BX" => "PER BOX",
                        "CS" => "CASE",
                        "FBM" => "PER BOARD FOOT",
                        "FT" => "PER FOOT",
                        "GAL" => "PER GALLON",
                        "KIT" => "PER KIT",
                        "LF" => "PER LINEAR FOOT",
                        "LT" => "PER LITER",
                        "LYD" => "PER LINEAR YARD",
                        "MR" => "PER METER",
                        "PK" => "PER PACK",
                        "PR" => "AS A PAIR",
                        "ROL" => "PER ROLL",
                        "QRT" => "PER QUART",
                        "RL" => "PER ROLL",
                        "SET" => "AS A SET",
                        "SQF" => "PER SQUARE FOOT",
                        "YD" => "PER YARD",
                    ] as $key => $value)
                        <option
                                @if( old('unit_of_measure') && old('unit_of_measure') === $key )
                                    selected
                                @endif
                                value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                </select>
            </div>


            <div class="row">
                <label for="description_2"
                       class="col-sm-2 col-form-label"></label>
                <div class="col-5">
                    <input type="text"
                           class="form-control "
                           id="description_2"
                           placeholder="Description line 2"
                           value="{{ old('description_2') }}">
                </div>
            </div>

            <div class="row">
                <label for="bin"
                       class="col-sm-2 col-form-label">Bin Location</label>
                <div class="col-2">
                    <input type="text"
                           class="form-control "
                           id="bin"
                           placeholder="Bin Location"
                           value="{{ old('bin') }}">
                </div>
            </div>

            <div class="row">
                <label for="group"
                       class="col-sm-2 col-form-label">Area</label>
                <div class="col-2">
                    <input type="text"
                           class="form-control "
                           id="group"
                           placeholder="Area"
                           value="{{ old('group') }}">
                </div>
            </div>


            <div class="row">
                <div class="col-2">
                    <label for="warehouse">Warehouse</label>

                </div>
                <div class="col-3">
                    <select name="warehouse"
                            class="form-control"
                            id="warehouse">
                        @foreach([
                                "01" => "Wharehouse 01",
                            "50" => "Floor stock 50",
                        ] as $key => $value)
                            <option
                                    @if( old('warehouse') && old('warehouse') === $key )
                                    selected
                                    @endif
                                    value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        <input type="hidden"
               id="expected_quantity"
               value="0"
               name="expected_quantity">


        <input type="submit"
           value="Save and Continue {{ app('request')->input('group') }}"
           class="btn btn-success">

        </div>
    </form>
</div>


{{--        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-4">--}}
{{--                <label class="" for="stock_code">Stock Code</label>--}}
{{--                <input type="text"--}}
{{--                       class="form-control"--}}
{{--                       required--}}
{{--                       id="stock_code"--}}
{{--                       value="{{ app('request')->input('stock_code') ??  old('stock_code') }}"--}}
{{--                       name="stock_code">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div class="col-4">--}}
{{--                <label class="uk-form-label" for="description_1">Description</label>--}}
{{--                    <input type="text"--}}
{{--                           class="form-control"--}}
{{--                           id="description_1"--}}
{{--                           name="description_1">--}}
{{--                <br>--}}

{{--                <label class="uk-form-label" for="description_2"></label>--}}
{{--                    <input type="text"--}}
{{--                           class="form-control"--}}
{{--                           id="description_2"--}}
{{--                           value="{{ old('description_2') }}"--}}
{{--                           name="description_2">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div class="col-md-3">--}}
{{--                <label class="" for="unit_of_measure">Unit of Measure</label>--}}
{{--                <input type="text"--}}
{{--                       class="form-control"--}}
{{--                       required--}}
{{--                       id="unit_of_measure"--}}
{{--                       value="{{ old('unit_of_measure', 'EA') }}"--}}
{{--                       name="unit_of_measure">--}}
{{--            </div>--}}
{{--        </div>--}}

{{--<div class="row">--}}
{{--    <div class="col-md-3">--}}
{{--        <label class="" for="bin">Bin Location</label>--}}
{{--        <input type="text"--}}
{{--               class="form-control"--}}
{{--               id="bin"--}}

{{--               value="{{ app('request')->input('bin') ?? old('bin') }}"--}}
{{--               name="bin">--}}
{{--    </div>--}}

{{--    <div class="col-md-3">--}}
{{--        <label class="" for="group">Group</label>--}}
{{--        <input type="text"--}}
{{--               class="form-control"--}}
{{--               id="group"--}}
{{--               required--}}
{{--               value="{{ app('request')->input('group') ?? old('group') }}"--}}
{{--               name="group">--}}
{{--    </div>--}}

{{--    <div class="col-md-3">--}}
{{--        <label class="" for="locale">Locale</label>--}}
{{--        <input type="text"--}}
{{--               class="form-control"--}}
{{--               id="locale"--}}

{{--               value="{{ app('request')->input('locale') ?? old('locale') }}"--}}
{{--               name="locale">--}}
{{--    </div>--}}

{{--    <div class="col-md-3">--}}
{{--        <label class="" for="warehouse">Warehouse</label>--}}
{{--        <input type="text"--}}
{{--               class="form-control"--}}
{{--               id="warehouse"--}}

{{--               value="{{ app('request')->input('warehouse') ?? old('warehouse') }}"--}}
{{--               name="warehouse">--}}
{{--    </div>--}}

{{--</div>--}}



{{--        <div>--}}

{{--            @if ( app('request')->input('group') )--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to group {{ app('request')->input('group') }}"--}}
{{--                       class="btn btn-success">--}}
{{--            @elseif ( app('request')->input('locale') )--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to locale {{ app('request')->input('locale') }}"--}}
{{--                       class="btn btn-success">--}}
{{--            @elseif ( app('request')->input('bin') )--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to bin {{ app('request')->input('bin') }}"--}}
{{--                       class="btn btn-success">--}}
{{--            @elseif ( app('request')->input('warehouse') )--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to warehouse {{ app('request')->input('warehouse') }}"--}}
{{--                       class="btn btn-success">--}}

{{--            @elseif ( app('request')->input('stock_code') )--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to Stock Code {{ app('request')->input('stock_code') }}"--}}
{{--                       class="btn btn-success">--}}
{{--            @else--}}
{{--                <input type="submit"--}}
{{--                       value="Save and back to previous page"--}}
{{--                       class="btn btn-success">--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </form>--}}

@endsection
