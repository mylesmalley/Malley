<div>


    <div class="card border-primary">
        <div class="card-header bg-primary text-white text-center">
            <h3>

            {{ $title ?? "Configuration of Blueprint B-". $blueprint->id }}

            @if(! $showAllOptions )
                <button class="btn btn-secondary float-end" wire:click="showAllOptions">Show All Options</button>
            @else
                <button class="btn btn-secondary float-end" wire:click="showAllOptions">Show Only Selected Options</button>

            @endif
            </h3>

        </div>
        <table class="table table-sm table-striped table-hover">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Dealer Price</th>
                <th class="text-end">MSRP</th>
            </tr>
            </thead>

            @foreach( $configurations as $config )
                @livewire("blueprint::configuration-line", [ 'configuration' => $config, 'pricing' => true ], key( $config->id) )
            @endforeach

            @livewire("blueprint::custom-quote-line", [ $blueprint ]  )

            @livewire("blueprint::quote-total-line", [ $blueprint, 3 ]  )

        </table>
    </div>

</div>