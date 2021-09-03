@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">Quote</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-secondary float-end"
               href="{{ route('blueprint.home', [ $blueprint ]) }}"> Back to Blueprint</a>
        </div>
    </div>
    <br>

    @livewire("blueprint::quote-details", [ $blueprint  ]  )

    <br />

    @livewire("blueprint::quote-body", [ $blueprint  ]  )



    <br />

    <div class="card border-secondary">
        <div class="card-header bg-secondary text-white">
            Get PDF of Quote
        </div>
        <div class="card-body text-center">
            <a class="btn btn-primary"
               href="{{ route('blueprint.quote.output_to_pdf', [$blueprint]) }}">No Pricing</a>

            <a class="btn btn-info"
               href="{{ route('blueprint.quote.output_to_pdf', [$blueprint, 'dealer']) }}">Dealer Pricing</a>

            <a class="btn btn-dark"
               href="{{ route('blueprint.quote.output_to_pdf', [$blueprint,'dealer_total_only']) }}">Dealer Total Only</a>

            <a class="btn btn-success"
               href="{{ route('blueprint.quote.output_to_pdf', [$blueprint, 'msrp']) }}">MSRP</a>

            <a class="btn btn-secondary"
               href="{{ route('blueprint.quote.output_to_pdf', [$blueprint,'msrp_total_only']) }}">MSRP Total Only</a>

            <p>The quote will be emailed to you at {{ Auth::user()->email }}</p>
        </div>
    </div>
    <br /><br /><br /><br />

@endsection