<tr class="table-info">
    <form wire:submit.prevent="save">
        <td>Custom Item</td>
        <td>

            <input type="text"
                   aria-label="description"
                   wire:model="configuration.description"
                   wire:keydown.Enter="save"

                   placeholder="Description of custom line"
                   class="form-control form-control-sm">
{{--            <button wire:click="save">go</button>--}}

            @error('configuration.description') <span class="text-danger">{{ $message }}</span><br> @enderror
            @error('configuration.price_tier_2') <span class="text-danger">{{ $message }}</span><br> @enderror
            @error('configuration.price_tier_3') <span class="text-danger">{{ $message }}</span><br> @enderror
            @error('configuration.quantity') <span class="text-danger">{{ $message }}</span><br> @enderror

        </td>
        <td>
            <input type="text"
                   aria-label="quantity"
                   wire:model="configuration.quantity"
                   wire:keydown.Enter="save"

                   placeholder="1"
                   style="width:70px;"
                   class="form-control form-control-sm float-end">
        </td>
        <td>
            <input type="text"
                   aria-label="dealer price"
                   wire:model="configuration.price_tier_2"
                   wire:keydown.Enter="save"

                   placeholder=""
                   style="width:70px;"
                   class="form-control form-control-sm float-end">
        </td>
        <td>
            <input type="text"
                   aria-label="MSRP"
                   wire:model="configuration.price_tier_3"
                   wire:keydown.Enter="save"
                   placeholder=""
                   style="width:70px;"
                   class="form-control form-control-sm float-end">
        </td>
    </form>
</tr>
