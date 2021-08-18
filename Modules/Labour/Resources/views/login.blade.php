@extends('labour::layouts.master')

@section('content')
    <div class="container">

        <div class="row g-7" style="padding-top:20%;">

            <div class="col-12 text-center">

                <h1 class="display-1">Labour Login</h1>
            </div>

            <div>

            @livewire("labour::alphabet")
                @livewire("labour::letter")
                @livewire("labour::login-form")

            </div>


        </div>

    </div>

    @push('scripts')
        <script>
            Livewire.on('test', () => {
                document.getElementById('password').focus();
            })
            @if ( $user )
                window.onload = function(){
                    {{--console.log( 'preload user',[ 'user_id' , {{ $user->id }}  ]);--}}
                    Livewire.emit('hide', {
                        'user' : {{ $user->id }},
                        'letter': '{{ substr($user->last_name, 0, 1) }}'
                    });


                    Livewire.emit('selectedUser', { 'user_id' : {{ $user->id }}, 'retry' : true  } );

            };

           // let x = ;

            @endif
        </script>
    @endpush
@endsection
