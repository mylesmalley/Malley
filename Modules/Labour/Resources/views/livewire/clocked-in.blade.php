<div>
    <!-- clocked-in -->
    <div dusk="clocked-in-component" class="alert alert-success border-success">
        <h2 class="alert-heading">Clocked In
            <form class="float-end" action="{{ route('labour.clock_out') }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $labour->id }}" />
                <input type="submit" value="Clock Out of {{ $labour->job ?? "NOT SET" }}"
                       id="clockOutButton"
                       dusk="clockOutButton"
                       class="btn btn-lg btn-success">
            </form>
        </h2>
        <hr>
        <p style="font-size: 16pt; ">

            You are clocked in on job <strong>

         {{ $labour->job ?? "NOT SET" }}</strong> since <strong>{{  $labour->start->format('g:i A ')  }}</strong>

        </p>

            <br>


        </div>
</div>
