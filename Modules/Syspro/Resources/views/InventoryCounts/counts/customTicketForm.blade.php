@extends('syspro::InventoryCounts.template')

@section('content')

    <h1>Custom List of Tickets</h1>

    <a href="{{ url('syspro/inventory/'.$inventory->id) }}"
       class="btn btn-dark btn-lg">Back to the Count</a>


    <form method="POST" action="{{ url('syspro/inventory/'.$inventory->id.'/customTickets') }}">
        {{ csrf_field() }}

        <label for="ids">IDs of tickets to create</label>
        <textarea name="ids" class="form-control" id="ids" required></textarea>

        <input type="submit" class="btn btn-lg btn-primary" value="Generate Tickets">
    </form>

    @endsection
