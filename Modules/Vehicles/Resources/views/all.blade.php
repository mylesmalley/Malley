<html lang="en">
    <head>
       <title>All Vehicles</title>
    </head>
    <body>
    {!! $vehicles->links() !!}

    <div class="card border-primary">


    <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>VIN</th>
                    <th>Work Order</th>
                    <th>Malley #</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $vehicles as $v )
                    <tr>
                        <td><a href="{{ url('/vehicles/'.$v->id ) }}">{{ $v->id }}</a></td>
                        <td >{{ $v->vin }}{{ $v->validVin ? '' : "####" }}</td>
                        <td>{{ $v->work_order }}</td>
                        <td>{{ $v->malley_number }}</td>
                        <td><a href="{{ url('/vehicles/compare/'.$v->id.'/'.$v->id  ) }}">Compare</a></td>
                    </tr>
                    @endforeach
            </tbody>
        </table>

    </div>

    {{ $vehicles->links() }}
    </body>
</html>
