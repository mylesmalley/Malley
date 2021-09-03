<div>


    <div class="card border-primary">
        <div class="card-header bg-primary text-white text-center">
{{--            {{ $title ?? "Configuration of Blueprint B-". $blueprint->id }}--}}
            <button wire:click="$refresh">Refresh</button>
        </div>
        <table class="table table-sm table-striped table-hover">
            <thead>
            <tr>
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