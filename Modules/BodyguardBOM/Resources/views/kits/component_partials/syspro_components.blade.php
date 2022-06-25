
<div class="card border-primary ">
    <div class="card-header bg-primary text-white ">
        Components in Syspro
        @if( $show_edit_button ?? true )
            <a href="{{ route('bg.kits.components', $kit->id) }}"
               class='btn btn-sm btn-secondary float-end'>Edit</a>
        @endif
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Part</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>UoM</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse( $syspro_components as $component)
            <tr>
                <td><a
                    @if( str_starts_with( $component->Component , 'BGC') )
                            href="{!! route('bg.kits.show_by_part_number', trim( $component->Component ) ) !!}">

                        @else
                            href="{!! route('stock_code_query', trim( $component->Component ) ) !!}">

                     @endif
                    {{ $component->Component }}
                    </a></td>
                <td> {{ $component->Description }} </td>
                <td> {{ number_format( $component->QtyPer, 3) }} </td>
                <td> {{ $component->StockUom }} </td>
                <td>
                    <img style="width:100px;" src="{{ route('stock_code_thumbnail', trim( $component->Component )) }}" alt="">
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">No components in Syspro</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>