<div class="card border-primary ">
    <div class="card-header bg-primary text-white ">
        Local Copy of Components

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
        @forelse( $local_components as $component)
            <tr>
                <td><a href="{{ route('stock_code_query', $component->stock_code ) }}">
                    {{ $component->stock_code }}
                    </a></td>
                <td> {{ $component->description }} </td>
                <td> {{ number_format( $component->quantity, 3) }} </td>
                <td> {{ $component->uom }} </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">No local components</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>