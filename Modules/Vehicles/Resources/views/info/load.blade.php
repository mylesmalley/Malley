


<div class='row text-center'>
    <div class='col-md-12'>
        <h1 class="display-4">Load Test</h1>
    </div>
</div>

<div class='row text-center'>
    <div class="offset-4 col-md-4">
        <div class="form-group">
            <label class="control-label" for="load_test_date">Load Test Date</label>
            <div class="input-group">
                <input type="date"
                       name="load_test_date"
                       value="{{ old('load_test_date') ?? $vehicle->load_test_date ?? "" }}"
                       id="load_test_date"
                       class="form-control">
            </div>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class='offset-3 col-md-3'>
        <div class="form-group">
            <label class="control-label" for="load_test_1_lowest">Test 1 Lowest (Main Volts)</label>
            <div class="input-group">
                <input type="text"
                       name="load_test_1_lowest"
                       value="{{ round( old('load_test_1_lowest') ?? $vehicle->load_test_1_lowest, 2 ) ?? "" }}"
                       id="load_test_1_lowest"
                       class="form-control">
                <span class="input-group-text" title='Volts'>Volts</span>

            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <label class="control-label" for="load_test_2_lowest">Test 2 Lowest (Main Volts)</label>
            <div class="input-group">
                <input type="text"
                       name="load_test_2_lowest"
                       value="{{ round( old('load_test_2_lowest') ?? $vehicle->load_test_2_lowest ,2)  ?? "" }}"
                       id="load_test_2_lowest"
                       class="form-control">
                <span class="input-group-text" title='Volts'>Volts</span>

            </div>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class='offset-3 col-md-3'>
        <div class="form-group">
            <label class="control-label" for="load_test_1_highest">Test 1 Highest  (Alternator Amps)</label>
            <div class="input-group">
                <input type="text"
                       name="load_test_1_highest"
                       value="{{ round( old('load_test_1_highest') ?? $vehicle->load_test_1_highest ,2)  ?? "" }}"
                       id="load_test_1_highest"
                       class="form-control">
                <span class="input-group-text" title='Amps'>Amps</span>

            </div>
        </div>
    </div>
    <div class='col-md-3'>
        <div class="form-group">
            <label class="control-label" for="load_test_2_highest">Test 2 Highest (Alternator Amps)</label>
            <div class="input-group">
                <input type="text"
                       name="load_test_2_highest"
                       value="{{ round( old('load_test_2_highest') ?? $vehicle->load_test_2_highest ,2) ?? "" }}"
                       id="load_test_2_highest"
                       class="form-control">
                <span class="input-group-text" title='Amps'>Amps</span>
            </div>
        </div>
    </div>
</div>


{{--     END OF ELECTRICAL TEST   --}}
