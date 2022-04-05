<div class="card border-secondary bg-secondary text-white"

     style="background-color: {{ $user->unique_colour() }} !important;
             border-color: {{ $user->unique_colour() }} !important;">
    <div class="card-body">
        <h1>Hello, {{ $user->first_name }} {{ $user->last_name }}
            <form class="float-end" method="POST" action="{{ route('labour.logout') }}">
                @csrf
                <input type="submit"
                       class="btn btn-lg btn-warning"
                       value="Log Out">
            </form>
        </h1>
    </div>
</div>
