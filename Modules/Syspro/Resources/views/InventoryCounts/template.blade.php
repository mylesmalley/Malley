<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
              crossorigin="anonymous">

        <title>Inventory Counts</title>
    </head>
    <body>

    @if( isset( $inventory ) )
    <nav class="navbar navbar-dark bg-secondary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ $inventory->description }}</a>
            <div class="d-flex">
                @foreach(["Stock Code" =>'stock_code',
                            "Bin" => 'bin',
                            'Locale'=>'locale',
                            'Warehouse' => 'warehouse',
                            'Group'=>'group', as $name => $section)
                <form class="form-inline"
                      method="POST"
                      action="{{ url('syspro/inventory/'.$inventory->id.'/search') }}">

                    {{ csrf_field() }}
                    <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                    <input type="hidden" name="filter" value="All">
                    <div class="input-group">
                        <input type="hidden" name="area" value="{{ $section }}">
                        <input class="form-control" type="text"

                               name="term"
                               placeholder="{{ $name }}" aria-label="Search">
                        <input type="submit" class="btn btn-dark" value="Search">
                    </div>
                </form>
                    &nbsp;
                    @endforeach

                    <form class="form-inline"
                          method="POST"
                          action="{{ url('syspro/inventory/'.$inventory->id.'/search') }}">

                        {{ csrf_field() }}
                        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
                        <input type="hidden" name="filter" value="All">
                        <div class="input-group">
                            <input type="hidden" name="area" value="ticket_number">
                            <input class="form-control" type="text"

                                   name="term"
                                   placeholder="Ticket Number" aria-label="Search">
                            <input type="submit" class="btn btn-dark" value="Search">
                        </div>
                    </form>

            </div>
        </div>
    </nav>
    @endif


        @yield('content')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        @yield('scripts')

    </body>

</html>
