<div class="card border-secondary ">
    <div class="card-header bg-secondary text-white ">
        Local Copy of Components

    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Part</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>UoM</th>
            <th></th>
            <th></th>
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
                <td>
                    <img style="width:100px;" src="{{ route('stock_code_thumbnail', trim($component->stock_code )) }}" alt="">
                </td>
                <td>
                    <form action="{{ route('bg.kits.components.delete', $kit->id) }}"
                            method="POST">
                        @method("DELETE")
                        @csrf
                        <input type="hidden"
                               value="{{ $component->id }}"
                               name="id"
                               id="id">
                        <input type="submit" class="btn btn-danger btn-sm" value="x">

                    </form>
                    
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100">No local components</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>