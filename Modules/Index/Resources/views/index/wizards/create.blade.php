@extends('index::app.main')

@section('content')

    <div class="row">
        <h1>
            New Wizard for {{ $basevan->name }}
        </h1>
    </div>

    <br>

    @includeIf('app.components.errors')

    <div class="card border-primary">

        <div class="card-header">
            New Wizard
        </div>

        <div class="card-body">
            <form action="">

                <div class="row">
                    <div class="col-6">
                        <label for="name">Wizard Name</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               id="name"
                               value="{{ old('name') }}">
                    </div>
                </div>
            </form>

        </div>

    </div>


@endsection
