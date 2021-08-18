@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="uk-heading-medium">New Item and Location</h1>

    @includeIf('syspro::InventoryCounts.errors')

    <form class="form"
          action="{{ url('syspro/inventory/'.$inventory->id.'/items/create') }}"
          method="POST">
        {{ csrf_field() }}

        <input type="hidden"
               id="expected_quantity"
               value="0"
               name="expected_quantity">


        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">

        <div class="row">
            <div class="col-md-4">
                <label class="" for="stock_code">Stock Code</label>
                <input type="text"
                       class="form-control"
                       required
                       id="stock_code"
                       value="{{ app('request')->input('stock_code') ??  old('stock_code') }}"
                       name="stock_code">
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <label class="uk-form-label" for="description_1">Description</label>
                    <input type="text"
                           class="form-control"
                           id="description_1"
                           value="{{ old('description_1') }}"
                           name="description_1">
                <br>

                <label class="uk-form-label" for="description_2"></label>
                    <input type="text"
                           class="form-control"
                           id="description_2"
                           value="{{ old('description_2') }}"
                           name="description_2">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="" for="unit_of_measure">Unit of Measure</label>
                <input type="text"
                       class="form-control"
                       required
                       id="unit_of_measure"
                       value="{{ old('unit_of_measure', 'EA') }}"
                       name="unit_of_measure">
            </div>
        </div>

<div class="row">
    <div class="col-md-3">
        <label class="" for="bin">Bin Location</label>
        <input type="text"
               class="form-control"
               id="bin"

               value="{{ app('request')->input('bin') ?? old('bin') }}"
               name="bin">
    </div>

    <div class="col-md-3">
        <label class="" for="group">Group</label>
        <input type="text"
               class="form-control"
               id="group"
               required
               value="{{ app('request')->input('group') ?? old('group') }}"
               name="group">
    </div>

    <div class="col-md-3">
        <label class="" for="locale">Locale</label>
        <input type="text"
               class="form-control"
               id="locale"

               value="{{ app('request')->input('locale') ?? old('locale') }}"
               name="locale">
    </div>

    <div class="col-md-3">
        <label class="" for="warehouse">Warehouse</label>
        <input type="text"
               class="form-control"
               id="warehouse"

               value="{{ app('request')->input('warehouse') ?? old('warehouse') }}"
               name="warehouse">
    </div>

</div>



        <div>

            @if ( app('request')->input('group') )
                <input type="submit"
                       value="Save and back to group {{ app('request')->input('group') }}"
                       class="btn btn-success">
            @elseif ( app('request')->input('locale') )
                <input type="submit"
                       value="Save and back to locale {{ app('request')->input('locale') }}"
                       class="btn btn-success">
            @elseif ( app('request')->input('bin') )
                <input type="submit"
                       value="Save and back to bin {{ app('request')->input('bin') }}"
                       class="btn btn-success">
            @elseif ( app('request')->input('warehouse') )
                <input type="submit"
                       value="Save and back to warehouse {{ app('request')->input('warehouse') }}"
                       class="btn btn-success">

            @elseif ( app('request')->input('stock_code') )
                <input type="submit"
                       value="Save and back to Stock Code {{ app('request')->input('stock_code') }}"
                       class="btn btn-success">
            @else
                <input type="submit"
                       value="Save and back to previous page"
                       class="btn btn-success">
            @endif
        </div>
    </form>

@endsection
