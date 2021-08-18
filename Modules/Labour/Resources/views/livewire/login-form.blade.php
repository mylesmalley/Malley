<div style="display:{{ ($user) ? 'block' : "none" }}">

    @if ($user)
    <!--  PinPad Component -->


    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <h1>Hello, {{ $user->first_name }}
                <button dusk="deselectUser" class="btn btn-secondary float-end" wire:click="deselectUser">Back</button>
            </h1>
        </div>

        <div class="card-body">
            <div class="row">

                @if( $retry )
                    <span class="text-danger">
                            Please retry your password.
                    </span>

                    @endif
                <form method="post" action="{{ route('labour.submitLogin') }}">
                    {{ csrf_field() }}

                    <input type="hidden" id="id" name="id" value="{{ $user->id }}" >

                    <input type="Password"
                           aria-label="Password"
                           id="password"
                           name="password"
                           class="form-control"
                           value=""
                           wire:model="pin" >

                    <input type="submit"
                           dusk="submitLoginFormButton"
                           class="btn btn-lg btn-success" value="Log In">

                </form>

            </div>

        </div>



    </div>


    @endif
</div>
