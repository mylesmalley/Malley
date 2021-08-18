@if ($errors->any())
    <div class="row">

        <div class="offset-3 col-6 card bg-danger text-white">
            <div class="card-header">
                Problems
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

    <br>
@endif
