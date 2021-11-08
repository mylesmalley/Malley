
        @foreach( $options as $option )
               <h4>{{ $option->option_name }}<br>
                {{ $option->option_description }}</h4>

               <table>
                        <thead>
                        <tr>
                            <th>StockCode</th>
                            <th>Description</th>
                            <th>QTY</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse( $option->components as $c )
                                <tr>
                                    <td>{{ $c->component_stock_code }}</td>
                                    <td>{{ $c->component_description }}</td>
                                    <td>{{ $c->component_material_qty }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100">No components added yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
               <hr>
        @endforeach
