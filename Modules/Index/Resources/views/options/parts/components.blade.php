<div class="card border-primary ">
    <div class="card-header bg-primary text-white">Components from
        <b>{{ $option->option_syspro_phantom }}</b>
        @if( !$option->obsolete )
            @if( Auth::user()->can_edit_options )

                <a href="{{ url('/index/option/'.$option->id.'/components') }}"
                   class='btn btn-sm btn-secondary float-end'>Edit</a>

            @endif
        @endif
    </div>


    <table class="table table-sm table-hover table-striped">
        <thead >
        <tr>
            <th>QTY</th>
{{--            <th>Sub<br />Assy</th>--}}
            <th>Stock Code</th>
            <th>Description</th>
            <th>Part Category</th>

            <th>Total Cost</th>
{{--            <th>Rev</th>--}}
{{--            <th>Item<br /> Code</th>--}}
{{--            <th>Where<br /> Built<br /> Location</th>--}}
{{--            <th>Install<br /> Area</th>--}}
            <th>Thumbnail</th>
        </tr>
        </thead>
        <tbody>

        @foreach($components as $component)
            <!-- only authorized users can get to the edit component page -->

            <tr >
                <td>{{ $component->component_material_qty }}</td>

{{--                <td>{{ $component->component_sub_assembly }}</td>--}}
                <td><a href="{{ url("/syspro/inventoryQuery/{$component->component_stock_code}") }}">
                    {{ $component->component_stock_code }}
                    </a></td>
                <td>{{ $component->component_description }}</td>
                <td>{{ $component->component_part_category }}</td>
                <td>{{ number_format( $component->totalCost, 2 ) }}</td>
                <td>
                        <img src="{{ route('stock_code_thumbnail', $component->component_stock_code) }}" style="width:125px;"
                             alt="{{ $component->component_stock_code }} thumbnail">
                </td>
{{--                <td>{{ $component->component_revision }}</td>--}}
{{--                <td>{{ $component->component_item_code }}</td>--}}
{{--                <td>{{ $component->component_where_built_location }}</td>--}}
{{--                <td>{{ $component->component_install_area }}</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
