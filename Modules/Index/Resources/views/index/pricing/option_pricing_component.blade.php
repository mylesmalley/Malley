<div>
    <div class="row">
        <div class="col-2">
            {{ $option->option_name }}
        </div>
        <div class="col-5">
            {{ $option->option_description }}
        </div>
        <div class="col-2 text-end">
            {{ $option->price_tier_2 ?? '' }}
        </div>
        <div class="col-2 text-end">
            {{ $option->price_tier_3 ?? '' }}

        </div>
    </div>
</div>