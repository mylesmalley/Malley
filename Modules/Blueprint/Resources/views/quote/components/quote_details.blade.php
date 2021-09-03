<div class="card border-secondary">
    <div class="card-header bg-secondary text-white">
        Quote Details
    </div>
    <div class="card-body">
        <form wire:submit.prevent="">

            <div class="row">

                <div class="col-4 text-primary">
                    <h3 class="">Instructions</h3>
                    <p> Changes to the fields in this box will be saved automatically. </p>
                    <p>To make changes to a line on the quote, click on it below. It will expand to show more options.</p>

                </div>

                <div class="col-4">
                    <h3>Quote Details</h3>


                    <div class="row">
                        <div class="col-12">
                            @error('blueprint.quote_number') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="quote_number">Quote Number</label>
                            <input class="form-control form-control-sm"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.quote_number"
                                   id="quote_number" name="quote_number"
                                   placeholder="eg. QUOTE00001">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            @error('blueprint.currency') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="currency">Currency</label>
                            <select name="currency"
                                    class="form-control form-control-sm"
                                    wire:change.debounce.500ms="save"
                                    wire:change.debounce.500ms="$emit('update_total')"
                                    wire:change.debounce.500ms="$emit('reload_quote_body')"
                                    wire:model="blueprint.currency"
                                    id="currency">
                                <option value="USD">US Dollar</option>
                                <option value="CAD">Canadian Dollar</option>

                            </select>

                        </div>

                        <div class="col-5">
                            @error('blueprint.exchange_rate') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="exchange_rate">Exchange Rate</label>
                            <input class="form-control form-control-sm"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.exchange_rate"
                                   id="quote_number" name="exchange_rate"
                                   placeholder="eg 1.2">

                        </div>
                        <div class="col-4">
                            <a href="https://xe.com">Look Up Rates</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">

                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       value="0"
                                       wire:model="blueprint.terms"
                                       wire:change="save"
                                       name="terms"
                                       id="terms0"
                                >
                                <label class="form-check-label" for="terms0">
                                    No Terms
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       value="1"
                                       wire:model="blueprint.terms"
                                       wire:change="save"
                                       name="terms"
                                       id="terms1"
                                >
                                <label class="form-check-label" for="terms1">
                                    Standard Terms and Conditions
                                </label>
                            </div>

                        </div>
                    </div>

                </div>









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
                    </div>

                    <div class="row">
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

                    <div class="row">
                        <div class="col-4">
                            @error('blueprint.customer_city') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="customer_city">City</label>
                            <input class="form-control"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_city"
                                   id="customer_city" name="customer_city"
                                   placeholder="Smithville">
                        </div>
                        <div class="col-4">
                            @error('blueprint.customer_province') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="customer_province">State / Prov</label>
                            <input class="form-control"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_province"
                                   id="customer_province" name=customer_province"
                                   placeholder="Montana">
                        </div>
                        <div class="col-4">
                            @error('blueprint.customer_country') <span class="text-danger">{{ $message }}</span><br> @enderror
                            <label for="customer_country">Country</label>
                            <input class="form-control"
                                   type="text"
                                   wire:change.debounce.500ms="save"
                                   wire:model="blueprint.customer_country"
                                   id="customer_country" name=customer_country"
                                   placeholder="USA">
                        </div>
                    </div>
        </div>
            </div>
    </form>
</div>
</div>
