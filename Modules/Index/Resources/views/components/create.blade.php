@extends('index::app.main')

@section("content")
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('basevan' ) }}">Platforms</a></li>
            <li class="breadcrumb-item"><a href="{{ url('basevan/'.$option->base_van->id) }}">{{ $option->base_van->name }}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('option/'.$option->id) }}">{{ $option->option_name }}</a></li>
            <li class="breadcrumb-item">New Component</li>
        </ol>
    </nav>


    <h1>New Component for {{ $option->option_name }} </h1>
    @includeIf('app.components.errors')

    <form action="{{ url('/component') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="option_id" value="{{ $option->id }}">



        <div class="row alert alert-success">
            <div class='col-md-3'>
                <label for="find">Lookup Stock Code</label>
                <input type="text"
                       id="find"
                       class='form-control'
                       placeholder="e.g. 15-13200"
                       name="find">
            </div>
            <div class='col-md-1'><br />
                <h3> OR </h3>
            </div>
            <div class='col-md-3'><br />
                <a href="#" id="non-stock" class='btn btn-lg btn-success'>Manually Add Non-Stock</a>
            </div>
        </div>

        <br>

            <hr />
                <div class="row">
                    <div class='col-md-3'>
                        <label for="component_stock_code">Stock Code</label>
                        <input type="text"
                               id="component_stock_code"
                               class="form-control"
                               readonly
                               name="component_stock_code"  >
                    </div>
                    <div class='col-md-4'>
                        <label for="component_description">Description</label>
                        <input type="text"
                               class="form-control"
                               id="component_description"
                               readonly
                               name="component_description">
                        <br><label for="component_long_description"></label>
                        <input type="text"
                               id="component_long_description"
                               class="form-control"
                               readonly
                               name="component_long_description">
                    </div>
                    <div class='col-md-2'>
                        <label for="component_part_category">Part Category</label>
                        <input type="text"
                               id="component_part_category"
                               class="form-control"
                               readonly
                               name="component_part_category">
                    </div>
                    <div class='col-md-2'>
                        <label for="component_revision">Revision</label>
                        <input type="text"
                               id="component_revision"
                               placeholder="0"
                               class="form-control"
                               name="component_revision">
                    </div>
                </div>

        <br>
                <div class="row">
                    <div class='col-md-2'>
                        <label for="component_material_qty">Material QTY</label>
                        <input type="text"
                               id="component_material_qty"
                               placeholder="0"
                               class="form-control"
                               name="component_material_qty">
                    </div>
                    <div class='col-md-2'>

                        <label for="component_material_cost">Material Cost</label>
                        <input type="text"
                               id="component_material_cost"
                                readonly
                               class="form-control"
                               name="component_material_cost">
                    </div>

                    <div class='col-md-2'>
                        <label for="component_unit_of_measure">Unit of Measure</label>
                        <input type="text"
                               id="component_unit_of_measure"
                               readonly
                               class="form-control"
                               name="component_unit_of_measure">
                    </div>
                    <div class='col-md-2'>
                        <label for="component_price_category">Price Category</label>
                        <input type="text"
                               id="component_price_category"
                               class="form-control"
                               name="component_price_category">
                    </div>
                </div>
        <br>

        <div class="row">
                    <div class='col-md-4'>
                        <label for="component_sub_assembly">Sub Assembly</label>
                        <select name="component_sub_assembly"
                                class='form-control'
                                id="component_sub_assembly"
                        >
                            @foreach([
                                "MF1" => "MF BASE COMPONENTS - STEP 1",
                                "MF2" => "MF BASE COMPONENTS - STEP 2",
                                "AS1" => "ASSY BASE COMPONENTS - STEP 1",
                                "EL1" => "EL. BASE COMPONENTS - STEP 1",
                                "HVAC1" => "HVAC BASE COMPONENTS - STEP 1",
                                "AS2" => "ASSY BASE COMPONENTS - STEP 2",
                                "EL2" => "EL. BASE COMPONENTS - STEP 2",
                                "HVAC2" => "HVAC BASE COMPONENTS - STEP 2",
                                "AS3" => "ASSY BASE COMPONENTS - STEP 3"
                        ] as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                </div>
                    <div class='col-md-2'>
                        <label for="component_item_code">Item Code</label>
                        <input type="text"
                               id="component_item_code"
                               class="form-control"
                               name="component_item_code">
                    </div>
                    <div class='col-md-2'>
                        <label for="component_where_built_location">Where Built</label>
                        <input type="text"
                               id="component_where_built_location"
                               class="form-control"
                               name="component_where_built_location">
        </div>
                    <div class='col-md-2'>
                        <label for="component_install_area">Install Area</label>
                        <input type="text"
                               id="component_install_area"
                               class="form-control"
                               name="component_install_area">
        </div>
        </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="notes">Motes</label>
                    <textarea name="notes" class="form-control" id="notes" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="row">
                <input type="submit" class="btn btn-primary" value="Save New Component">
            </div>

    </form>


@endsection


@section('javascript')
    $(function(){
    $( "#find" ).autocomplete({
      source: "{{ url('syspro/search') }}",
      minLength: 3,
      delay: 500,
      focus: function( event, ui ) {
        $( "#find" ).val( ui.item.StockCode.trim() );
        return false;
      },
      select: function( event, ui ) {
        $('#component_description').empty().val( ui.item.Description );
        $('#component_long_description').empty().val( ui.item.LongDesc );
        $('#component_stock_code').empty().val( ui.item.StockCode.trim() );
        $('#component_material_cost').empty().val( ui.item.MaterialCost );
        $('#component_unit_of_measure').empty().val( ui.item.StockUom );
    $('#component_part_category').empty().val( ui.item.PartCategory );
    $('#component_price_category').empty().val( ui.item.PriceCategory );
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.StockCode + "<br>" + item.Description + "</div>" )
        .appendTo( ul );
    };

    });

    $('#non-stock').click(function(){
        $('#find').empty().prop('readonly',true);
        $('#component_description').empty().prop('readonly',false);
        $('#component_long_description').empty().prop('readonly',false);
        $('#component_stock_code').empty().prop('readonly',false);
        $('#component_material_cost').empty().prop('readonly',false);
        $('#component_unit_of_measure').prop('readonly',false);
        $('#component_part_category').empty().val( "N" );
    });
@endsection
