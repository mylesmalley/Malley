<div wire:key="custom_line_for_quote">
    <table>

        <tbody >
        <tr class="table-info">
            <td>Custom Item</td>
            <td>

                <input type="text"
                       aria-label="description"
                       wire:model="configuration.description"
                       placeholder="Description of custom line"
                       class="form-control form-control-sm">
                <button wire:click="save">go</button>

                @error('configuration.description') <span class="text-danger">{{ $message }}</span><br> @enderror
                @error('configuration.price_tier_2') <span class="text-danger">{{ $message }}</span><br> @enderror
                @error('configuration.price_tier_3') <span class="text-danger">{{ $message }}</span><br> @enderror
                @error('configuration.quantity') <span class="text-danger">{{ $message }}</span><br> @enderror

            </td>
            <td>
                <input type="text"
                       aria-label="quantity"
                       wire:model="configuration.quantity"
                       placeholder="1"
                       style="width:70px;"
                       class="form-control form-control-sm">
            </td>
            <td>
                <input type="text" s
                       aria-label="dealer price"
                       wire:model="configuration.price_tier_2"
                       placeholder=""
                       style="width:70px;"
                       class="form-control form-control-sm">
            </td>
            <td>
                <input type="text"
                       aria-label="MSRP"
                       wire:model="configuration.price_tier_3"
                       placeholder=""
                       style="width:70px;"
                       class="form-control form-control-sm">
            </td>
        </tr>
        </tbody>
    </table>
</div>
