<div id="fuel_tests">

    <div class="row text-center">
        <div class='col-md-12'>
            <h1 class="display-4">Weight Tests</h1>
        </div>
    </div>
    <br>

    <div class="row text-center">

        <div class='offset-4 col-md-4'>
            <div class="form-group">
                <label class="control-label"
                       for="tank_starting_fill_percent">
                    Tank Starting Fill Level
                </label>

                <div class="input-group">
                    <input type="number"
                           min="0"
                           max="100"
                           step="1"
                           name="tank_starting_fill_percent"
                           value="{{ old('tank_starting_fill_percent') ?? $vehicle->tank_starting_fill_percent ?? "" }}"
                           id="tank_starting_fill_percent"
                           v-model.number="fuelLevel"
                           class="form-control">
                    <span class="input-group-text" title='Percent'>%</span>
                </div>
            </div>
        </div>
    </div>


    <br>

    <div class="row">
        <div class="col-md-6">



    <div class="row text-center">
        <div class="col-md-12">
            <h3>Base Vehicle</h3>
        </div>
    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_weight_lf">
                    Left (Driver) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_weight_lf"
                           value="{{ old('base_weight_lf') ?? $vehicle->base_weight_lf ?? "" }}"
                           v-model.number="base_weight_lf"
                           id="base_weight_lf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_weight_rf">
                    Right (Passenger) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_weight_rf"
                           value="{{ old('base_weight_rf') ?? $vehicle->base_weight_rf ?? "" }}"
                           id="base_weight_rf"
                           v-model.number="base_weight_rf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_weight_lr">
                    Left (Driver) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_weight_lr"
                           value="{{ old('base_weight_lr') ?? $vehicle->base_weight_lr ?? "" }}"
                           v-model.number="base_weight_lr"
                           id="base_weight_lr"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_weight_rr">
                    Right (Passenger) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_weight_rr"
                           value="{{ old('base_weight_rr') ?? $vehicle->base_weight_rr ?? "" }}"
                           v-model.number="base_weight_rr"
                           id="base_weight_rr"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>


    {{--        BASE WEIGHTS WITH VEHICLE RIASED 10 INCHES--}}

    <br>
    <div class="row text-center">
        <div class="col-md-12">
            <h3>Weight with 10" Raise of Rear Wheels</h3>
        </div>
    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_weight_lf">
                    Left (Driver) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_weight_lf"
                           value="{{ old('base_raised_weight_lf') ?? $vehicle->base_raised_weight_lf ?? "" }}"
                           v-model.number="base_raised_weight_lf"
                           id="base_raised_weight_lf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_weight_rf">
                    Right (Passenger) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_weight_rf"
                           value="{{ old('base_raised_weight_rf') ?? $vehicle->base_raised_weight_rf ?? "" }}"
                           id="base_raised_weight_rf"
                           v-model.number="base_raised_weight_rf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_weight_lr">
                    Left (Driver) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_weight_lr"
                           value="{{ old('base_raised_weight_lr') ?? $vehicle->base_raised_weight_lr ?? "" }}"
                           id="base_raised_weight_lr"
                           v-model.number="base_raised_weight_lr"

                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_weight_rr">
                    Right (Passenger) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_weight_rr"
                           value="{{ old('base_raised_weight_rr') ?? $vehicle->base_raised_weight_rr ?? "" }}"
                           id="base_raised_weight_rr"
                           v-model.number="base_raised_weight_rr"

                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>



        </div>

        <div class="col-md-6">



    {{--        END OF BASE WEIGHTS WITH VEHICLE RAISED 10 INCHES--}}



    <br>

    <div class="row text-center">
        <div class="col-md-12">
            <h3>Fueled Vehicle</h3>
        </div>
    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_fueled_weight_lf">
                    Left (Driver) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_fueled_weight_lf"
                           value="{{ old('base_fueled_weight_lf') ?? $vehicle->base_fueled_weight_lf ?? "" }}"
                           id="base_fueled_weight_lf"
                           readonly
                           v-model.number="base_fueled_weight_lf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_fueled_weight_rf">
                    Right (Passenger) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_fueled_weight_rf"
                           value="{{ old('base_fueled_weight_rf') ?? $vehicle->base_fueled_weight_rf ?? "" }}"
                           id="base_fueled_weight_rf"
                           readonly
                           v-model.number="base_fueled_weight_rf"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_fueled_weight_lr">
                    Left (Driver) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_fueled_weight_lr"
                           value="{{ old('base_fueled_weight_lr') ?? $vehicle->base_fueled_weight_lr ?? "" }}"
                           id="base_fueled_weight_lr"
                           readonly
                           v-model.number="base_fueled_weight_lr"
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_fueled_weight_rr">
                    Right (Passenger) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_fueled_weight_rr"
                           value="{{ old('base_fueled_weight_rr') ?? $vehicle->base_fueled_weight_rr ?? "" }}"
                           id="base_fueled_weight_rr"
                           v-model.number="base_fueled_weight_rr"
                           readonly
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>


    {{--        BASE WEIGHTS WITH VEHICLE RIASED 10 INCHES--}}

    <br>
    <div class="row text-center">
        <div class="col-md-12">
            <h3>Fueled with 10" Raise of Rear Wheels</h3>
        </div>
    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_fueled_weight_lf">
                    Left (Driver) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_fueled_weight_lf"
                           value="{{ old('base_raised_fueled_weight_lf') ?? $vehicle->base_raised_fueled_weight_lf ?? "" }}"
                           id="base_raised_fueled_weight_lf"
                           v-model.number="base_raised_fueled_weight_lf"
                           readonly
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_fueled_weight_rf">
                    Right (Passenger) Front
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_fueled_weight_rf"
                           value="{{ old('base_raised_fueled_weight_rf') ?? $vehicle->base_raised_fueled_weight_rf ?? "" }}"
                           id="base_raised_fueled_weight_rf"
                           v-model.number="base_raised_fueled_weight_rf"

                           readonly
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row text-center">

        <div class='offset-3 col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_fueled_weight_lr">
                    Left (Driver) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_fueled_weight_lr"
                           value="{{ old('base_raised_fueled_weight_lr') ?? $vehicle->base_raised_fueled_weight_lr ?? "" }}"
                           id="base_raised_fueled_weight_lr"
                           v-model.number="base_raised_fueled_weight_lr"
                           readonly
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class="form-group">
                <label class="control-label"
                       for="base_raised_fueled_weight_rr">
                    Right (Passenger) Rear
                </label>

                <div class="input-group">

                    <input type="text"
                           name="base_raised_fueled_weight_rr"
                           value="{{ old('base_raised_fueled_weight_rr') ?? $vehicle->base_raised_fueled_weight_rr ?? "" }}"
                           id="base_raised_fueled_weight_rr"
                           v-model.number="base_raised_fueled_weight_rr"
                           readonly
                           class="form-control">
                    <span class="input-group-text" title='Pounds'>lb</span>
                </div>
            </div>
        </div>

    </div>


</div>

    </div>
</div>
{{--        END OF BASE WEIGHTS WITH VEHICLE RAISED 10 INCHES--}}

