@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="uk-heading-medium">Enter Blank Ticket</h1>

    @includeIf('syspro::InventoryCounts.errors')


    <div class="row">
        <div class="col-6 offset-3">

        </div>
    </div>


    <form class=""
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
