<div>
    <div class="row" wire:click="toggle_status">
        <div class="col-2">
            {{ $option->option_name }}
        </div>
        <div class="col-5">
            {{ $option->option_description }}
        </div>

        @if ( $active )
            <div class="col-2 text-end">
                <input aria-label=""
                       type="text"
                       name="price_tier_2"
                       class="form-control text-end"
                       wire:model="option.option_price_tier_2">
            </div>
            <div class="col-2 text-end">
                <input aria-label=""
                       type="text"
                       name="price_tier_3"
                       class="form-control text-end"
                       wire:model="option.option_price_tier_3">
            </div>
        @else

            <div class="col-2 text-end">
                {{ $option->price_tier_2 ?? '' }}
            </div>
            <div class="col-2 text-end">
                {{ $option->price_tier_3 ?? '' }}
            </div>
        @endif
    </div>
</div>