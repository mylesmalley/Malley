@if ( session('success') && count(session('success')) )
    <div class="row">
        <div class="col-12">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <ul>
                        @foreach( session('success') as $msg )
                            <li>{{ $msg }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
<br>
@endif