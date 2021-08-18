<h3>Wheels and Tires </h3>

<div class='row'>
    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="tire_size">Tire Size </label>
            <input type="text"
                   name="tire_size"
                   value=" {{ old('tire_size') ?? $vehicle->tire_size ?? "" }}"
                   id="tire_size"
                   class="form-control">
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="wheel_size">Wheel Size </label>
            <input type="text"
                   name="wheel_size"
                   value="{{ old('wheel_size') ?? $vehicle->wheel_size ?? "" }}"
                   id="wheel_size"
                   class="form-control">
        </div>
    </div>


    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="tire_diameter">Tire Diameter </label>
            <div class="input-group">
                <input type="text"
                       name="tire_diameter"
                       value="{{ old('tire_diameter') ?? $vehicle->tire_diameter ?? "" }}"
                       id="tire_diameter"
                       class="form-control">
                <span class="input-group-text" title='In Inches'>Inches</span>
            </div>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="front_tread_width">Front Tread Width </label>
            <div class="input-group">
                <input type="text"
                       name="front_tread_width"
                       value="{{ round( old('front_tread_width') ?? $vehicle->front_tread_width, 1) ?? "" }}"
                       id="front_tread_width"
                       class="form-control">
                <span class="input-group-text" title='In Inches'>Inches</span>
            </div>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="rear_tread_width">Rear Tread Width </label>
            <div class="input-group">
                <input type="text"
                       name="rear_tread_width"
                       value="{{ round( old('rear_tread_width') ?? $vehicle->rear_tread_width, 1) ?? "" }}"
                       id="rear_tread_width"
                       class="form-control">
                <span class="input-group-text" title='In Inches'>Inches</span>
            </div>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="wheelbase">Wheelbase </label>
            <div class="input-group">
                <input type="text"
                       name="wheelbase"
                       value="{{ old('wheelbase') ?? $vehicle->wheelbase ?? "" }}"
                       id="wheelbase"
                       class="form-control">
                <span class="input-group-text" title='In Inches'>Inches</span>
            </div>
        </div>
    </div>


    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="front_tire_pressure">Front Tire Pressure </label>
            <div class="input-group">
                <input type="text"
                       name="front_tire_pressure"
                       value="{{ old('front_tire_pressure') ?? $vehicle->front_tire_pressure ?? "" }}"
                       id="front_tire_pressure"
                       class="form-control">
                <span class="input-group-text" title='PSI'>PSI</span>
            </div>
        </div>
    </div>


    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="rear_tire_pressure">Rear Tire Pressure </label>
            <div class="input-group">
                <input type="text"
                       name="rear_tire_pressure"
                       value="{{ old('rear_tire_pressure') ?? $vehicle->rear_tire_pressure ?? "" }}"
                       id="rear_tire_pressure"
                       class="form-control">
                <span class="input-group-text" title='PSI'>PSI</span>
            </div>
        </div>
    </div>


    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="spare_tire_pressure">Spare Tire Pressure </label>
            <div class="input-group">
                <input type="text"
                       name="spare_tire_pressure"
                       value="{{ round( old('spare_tire_pressure') ?? $vehicle->spare_tire_pressure, 1 ) ?? "" }}"
                       id="spare_tire_pressure"
                       class="form-control">
                <span class="input-group-text" title='PSI'>PSI</span>
            </div>
        </div>
    </div>


</div>

