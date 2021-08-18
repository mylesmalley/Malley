@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="uk-heading-medium">Create</h1>

    @includeIf('syspro::InventoryCounts.errors')

    <form class="uk-form-horizontal"
          action="{{ url('syspro/inventory/create') }}"
          method="POST">
        {{ csrf_field() }}

        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

        <div>
            <label class="uk-form-label" for="description">Description</label>
            <div class="uk-form-controls">
                <input type="text"
                       class="uk-input"
                       id="description"
                       name="description">
            </div>
        </div>
        <div>
            <input type="submit" value="Save" class="uk-button uk-button-primary">
        </div>
    </form>

@endsection
