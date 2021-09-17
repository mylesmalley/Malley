<!doctype html>
<html lang="en">
    <head>
        <title>Malley Blueprint</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ mix('css/homepage.css') }}" >

        <meta name="csrf-token" content="{{ csrf_token() }}">

        @includeIf('homepage::googleAnalytics')
        @livewireStyles

        @yield('stylesheet')

        <!-- Header Script Stack -->
            @stack('header_scripts')
        <!-- END Header Script Stack -->


    </head>
    <body>

    @includeIf('homepage::malleyMenu')

    <br />


    <h4 class="text-secondary text-center">Malley Blueprint</h4>

        @if ($errors->any() )
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card border-danger text-white bg-danger">
                        <div class="card-header">
                            Ran into some issues...
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    @if( session('success') )
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card border-success text-white bg-success">
                        <div class="card-header">
                            <strong>Success</strong> :  {{ session('success') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class='container'>

            @yield('content')

        </div>

        <script src="{{ mix('js/homepage.js') }}"></script>

        @livewireScripts

        @stack('scripts')
    <script>
        function update_drawings()
        {
            console.log('refreshed drawings');
            fetch('{{ route('blueprint.form.activeDrawings', [$blueprint]) }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                }) .then(response => response.json())
                    .then( function(data) {
                        console.log( data );


                        var shapes = stage.find('Image');
                        shapes.forEach( function(el){
                            el.hide();
                        });


                        data.forEach( function( el ){
                            //    console.log( `option${el}` in window  );
                            //    console.log( `turn on option${el} ` )
                            if ( `option${el}` in window )
                            {
                                eval(`option${el}.show();`);

                                // console.log( `turned on "option" + ${el} ` )
                            }
                        });
                    });

        }



        Livewire.on('update-images', function(){
            update_drawings();

        });

        window.addEventListener('load', function() {
            update_drawings();
        })
    </script>
    </body>
</html>
