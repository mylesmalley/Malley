
        @foreach( $options as $option )
               <h4><a href="{{ route('option.home', [ $option ]) }}">{{ $option->option_name }}</a><br>
                {{ $option->option_description }}</h4>

               <table cellpadding="3" border="1">
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
                                    <td><a href="{{ route('stock_code_query', [$c->component_stock_code]) }}">{{ $c->component_stock_code }}</a></td>
                                    <td valign="top">{{ $c->component_description }} <br> {{ $c->component_long_description ?? '' }}</td>
                                    <td>{{ $c->component_material_qty }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100">No components added yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
               <br>
               <hr>

        @endforeach
