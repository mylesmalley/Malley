@if ($errors->any())
    <div>
        <div class="uk-card uk-card-default uk-card-body">
            <h3 class="uk-card-title">Errors</h3>
            <ul class="uk-text-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endif
