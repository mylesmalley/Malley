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
            <form action="{{ route('platform.wizard.store', [$basevan]) }}"
                  method="POST">
                @csrf
                <input type="hidden" name="base_van_id" value="{{ $basevan->id }}">

                <div class="row">
                    <div class="col-6">
                        <label for="name">Wizard Name</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               required
                               id="name"
                               value="{{ old('name') }}">
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="start_notes">Start Instructions</label>
                        <input type="text"
                               class="form-control"
                               name="start_notes"
                               required
                               id="start_notes"
                               value="{{ old('start_notes') }}">
                    </div>
                    <div class="col-6">
                        <label for="end_notes">Finish Instructions</label>
                        <input type="text"
                               class="form-control"
                               name="end_notes"
                               id="end_notes"
                               required
                               value="{{ old('end_notes') }}">
                    </div>

                    <div class="col-4">
                        <label for="completed_form_option">Option Activated When Finished</label>
                        <input type="text"
                               class="form-control"
                               name="completed_form_option"
                               id="completed_form_option"
                               required
                               value="{{ old('completed_form_option') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 offset-4 text-center">
                        <input type="submit" value="Create Wizard" class="btn btn-success">
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection
