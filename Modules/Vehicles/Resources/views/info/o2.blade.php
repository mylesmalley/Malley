

<div class='row text-center'>
    <div class='col-md-12'>
        <h1 class="display-4">O<sub>2</sub> Test</h1>
    </div>
</div>

<div class="row text-center">
    <div class='offset-3 col-md-3'>
        <div class="form-group">
            <label class="control-label" for="o2_test_date">Test Date</label>
            <div class="input-group">
                <input type="date"
                       name="o2_test_date"
                       value="{{ old('o2_test_date') ??  $vehicle->milestone('o2_test') ?? "" }}"
                       id="o2_test_date"
                       class="form-control">
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <label class="control-label" for="o2_test_temperature">Temperature</label>
            <div class="input-group">
                <input type="text"
                       name="o2_test_temperature"
                       value="{{ old('o2_test_temperature') ?? $vehicle->o2_test_temperature ?? "" }}"
                       id="o2_test_temperature"
                       class="form-control">
                <span class="input-group-text" title='In Pounds'>&deg;C</span>
            </div>
        </div>
    </div>
</div>
<div class="row text-center">
    <div class='offset-3 col-md-3'>
        <div class="form-group">
            <label class="control-label" for="os_test_start_pressure">Start Pressure</label>
            <div class="input-group">
                <input type="text"
                       name="os_test_start_pressure"
                       value="{{ old('os_test_start_pressure') ?? $vehicle->os_test_start_pressure ?? "" }}"
                       id="os_test_start_pressure"
                       class="form-control">
                <span class="input-group-text" title='PSIs'>PSI</span>
            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <label class="control-label" for="os_test_final_pressure">Final Pressure</label>
            <div class="input-group">
                <input type="text"
                       name="os_test_final_pressure"
                       value="{{ old('os_test_final_pressure') ?? $vehicle->os_test_final_pressure ?? "" }}"
                       id="os_test_final_pressure"
                       class="form-control">
                <span class="input-group-text" title='PSIs'>PSI</span>
            </div>
        </div>
    </div>
</div>


