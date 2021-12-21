@extends('homepage::layout')

@section('content')
        @includeIf('homepage::greeting')
{{--        @includeIf('MalleySearch.search')--}}
        <div id="search"></div>
    <br><br>

	<br>
	<div class="row">
        @includeIf('homepage::cards.labour')
        @includeIf('homepage::cards.inventory')
        @includeIf('homepage::cards.optionIndex')
        @includeIf('homepage::cards.vehicles')

	</div>
        <br>

        <div class="row">
            @includeIf('homepage::cards.issueTracker')
            @includeIf('homepage::cards.blueprint')

            @includeIf('homepage::cards.blueprintSalesSupport')
{{--            @includeIf('homepage::cards.documentation')--}}
        </div>
    <br>
        <div class="row">
            @includeIf('homepage::dashboards.blueprints')
{{--            @includeIf('homepage::dashboards.warranty')--}}
        </div>



@endsection
