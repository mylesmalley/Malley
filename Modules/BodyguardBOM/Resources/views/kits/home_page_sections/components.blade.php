<div class="card border-primary ">
    <div class="card-header bg-primary text-white ">
        Components
        <a href="{{ route('bg.kits.components', $kit->id) }}"
           class='btn btn-sm btn-secondary float-end'>Edit</a>

    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Part</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>UoM</th>
        </tr>
        </thead>
        <tbody>
        @forelse( $components as $component)
            <tr>
                <td><a href="{{ route('stock_code_query', $component->Component ) }}">
                    {{ $component->Component }}
                    </a></td>
                <td> {{ $component->Description }} </td>
                <td> {{ number_format( $component->QtyPer, 3) }} </td>
                <td> {{ $component->StockUom }} </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">No components in Syspro</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>