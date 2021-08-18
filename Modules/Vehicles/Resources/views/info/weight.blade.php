
<h3>OEM Weight Rating </h3>

<div class='row'>
    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="oem_gvwr">OEM GVWR</label>
            <div class="input-group">
                <input type="text"
                       name="oem_gvwr"
                       value="{{ old('oem_gvwr') ?? $vehicle->oem_gvwr ?? "" }}"
                       v-model.number="gvwr"
                       id="oem_gvwr"
                       class="form-control">
                <span class="input-group-text" title='In Inches'>lb</span>
            </div>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="oem_front_gawr">OEM Front GAWR</label>
            <div class="input-group">
                <input type="text"
                       name="oem_front_gawr"
                       value="{{ old('oem_front_gawr') ?? $vehicle->oem_front_gawr ?? "" }}"
                       id="oem_front_gawr"
                       class="form-control">
                <span class="input-group-text" title='In Pounds'>lb</span>
            </div>
        </div>
    </div>

    <div class='col-md-4'>
        <div class="form-group">
            <label class="control-label" for="oem_rear_gawr">OEM Rear GAWR</label>
            <div class="input-group">
                <input type="text"
                       name="oem_rear_gawr"
                       value="{{ old('oem_rear_gawr') ?? $vehicle->oem_rear_gawr ?? "" }}"
                       id="oem_rear_gawr"
                       class="form-control">
                <span class="input-group-text" title='In Pounds'>lb</span>
            </div>
        </div>
    </div>

</div>

