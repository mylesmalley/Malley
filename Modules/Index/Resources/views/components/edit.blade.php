@extends('index::app.main')

@section("content")
        <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('basevan' ) }}">Platforms</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('basevan/'.$option->base_van->id) }}">{{ $option->base_van->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('option/'.$option->id) }}">{{ $option->name }}</a></li>
                        <li class="breadcrumb-item">Edit Component</li>
                </ol>
        </nav>

        <form action="{{ url('/component/'.$component->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-xl btn-danger" value="DELETE COMPONENT">
        </form>



        <h1>Edit Component </h1>
        @includeIf('app.components.errors')

        <form action="{{ url( '/component/'.$component->id ) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field("PATCH") }}
            <input type="hidden" name="id" value="{{ $component->id }}" >

        <div class="row">

            <div class='col-md-3'>
                <label for="component_stock_code">Stock Code</label>
                <input type="text"
                       id="component_stock_code"
                       class="form-control"
                       readonly
                       value="{{ $component->component_stock_code ?? old('component_stock_code') ?? "" }}"
                       name="component_stock_code"  >
            </div>





            <div class='col-md-4'>
                <label for="component_description">Description</label>
                <input type="text"
                       class="form-control"
                       id="component_description"
                       readonly
                       value="{{ $component->component_description ?? old('component_description') ?? "" }}"
                       name="component_description">
                <br><label for="component_long_description"></label>
                <input type="text"
                       id="component_long_description"
                       class="form-control"
                       readonly
                       value="{{ $component->component_long_description ?? old('component_long_description') ?? "" }}"
                       name="component_long_description">
            </div>


            <div class='col-md-2'>
                <label for="component_part_category">Part Category</label>
                <input type="text"
                       id="component_part_category"
                       class="form-control"
                       readonly
                       value="{{ $component->component_part_category ?? old('component_part_category') ?? "" }}"

                       name="component_part_category">
            </div>
            <div class='col-md-2'>
                <label for="component_revision">Revision</label>
                <input type="text"
                       id="component_revision"
                       placeholder="0"
                       value="{{ $component->component_revision ?? old('component_revision') ?? "" }}"
                       class="form-control"
                       name="component_revision">
            </div>


        </div>


        <div class="row">
            <div class='col-md-2'>
                <label for="component_material_qty">Material QTY</label>
                <input type="text"
                       id="component_material_qty"
                       placeholder="0"
                       value="{{ old('component_material_qty') ?? $component->component_material_qty ?? 0 }}"
                       class="form-control"
                       name="component_material_qty">
            </div>

            <div class='col-md-2'>
                <label for="component_material_cost">Material Cost</label>
                <input type="text"
                       id="component_material_cost"
                       readonly
                       value="{{ old('component_material_cost') ?? $component->component_material_cost ?? 0 }}"
                       class="form-control"
                       name="component_material_cost">
            </div>

            <div class='col-md-2'>
                <label for="component_unit_of_measure">Unit of Measure</label>
                <input type="text"
                       id="component_unit_of_measure"
                       readonly
                       value="{{ old('component_unit_of_measure') ?? $component->component_unit_of_measure ?? "EA" }}"
                       class="form-control"
                       name="component_unit_of_measure">
            </div>

            <div class='col-md-2'>
                <label for="component_price_category">Price Category</label>
                <input type="text"
                       value="{{ old('component_price_category') ?? $component->component_price_category ?? "A" }}"
                       id="component_price_category"
                       class="form-control"
                       name="component_price_category">
            </div>
        </div>



            <div class="row">
                <div class='col-md-4'>
                    <label for="component_sub_assembly">Sub Assembly</label>
                    <select name="component_sub_assembly"
                            class='form-control'
                            id="component_sub_assembly" >
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
                            <option
                                {{ old('component_sub_assembly') === $k
                                    || $component->component_sub_assembly === $k ? 'selected' : '' }}
                                value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='col-md-2'>
                    <label for="component_item_code">Item Code</label>
                    <input type="text"
                           id="component_item_code"
                           value="{{ old('component_item_code') ?? $component->component_item_code ?? "" }}"
                           class="form-control"
                           name="component_item_code">
                </div>
                <div class='col-md-2'>
                    <label for="component_where_built_location">Where Built</label>
                    <input type="text"
                           id="component_where_built_location"
                           value="{{ old('component_where_built_location') ?? $component->component_where_built_location ?? "" }}"
                           class="form-control"
                           name="component_where_built_location">
                </div>
                <div class='col-md-2'>
                    <label for="component_install_area">Install Area</label>
                    <input type="text"
                           id="component_install_area"
                           value="{{ old('component_install_area') ?? $component->component_install_area ?? "" }}"
                           class="form-control"
                           name="component_install_area">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="notes">Motes</label>
                    <textarea name="notes" class="form-control" id="notes" cols="30" rows="10">{{ old('notes') ?? $component->notes ?? "" }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>

        </form>
@endsection
