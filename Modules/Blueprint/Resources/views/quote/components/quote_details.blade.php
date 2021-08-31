<div class="card border-secondary">
    <form wire:submit.prevent="">
        <div class="card-header bg-secondary text-white">
            Quote Details
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h3>Customer Details</h3>
                    <div class="row">
                        <div class="col-12">
                            @error('blueprint.customer_name') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="customer_name">Name</label>
                            <input class="form-control form-control-sm"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_name"
                                   id="customer_name" name="customer_name"
                                   placeholder="Customer Name">
                        </div>

                        <div class="col-12">
                            @error('blueprint.customer_address_1') <span class="text-danger">{{ $message }}</span><br> @enderror
                            @error('blueprint.customer_address_2') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="customer_address_1">Street</label>
                            <input class="form-control"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_address_1"
                                   id="customer_address_1" name="customer_address_1"
                                   placeholder="Street">
                            <input class="form-control"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_address_2"
                                   aria-label="street 2"
                                   id="customer_address_2" name="customer_address_2"
                                   placeholder="P.O. Box">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>