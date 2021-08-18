<br>
<div class="card bg-warning text-white">
    <div class="card-header">
        Import Components from Existing Phantom
    </div>
    <div class="card-body">
        <form class="row"
              method="POST"
              action="{{ route('importComponents') }}">
                @csrf
            <input type="hidden" name="option_id" value="{{ $option->id }}">
            <div class="col-3">
                <label  for="phantom">Import Phantom</label>

            </div>
            <div class="col-7">
                <input type="text"
                       required
                       class="form-control"
                       id="phantom"
                       value="{{ old('phantom') }}"
                       name="phantom"
                       placeholder="Why was this change made?">

            </div>

            <div class="col-2">
                <input type="submit" class="btn btn-warning" value="Import">

            </div>


        </form>
    </div>
    <div class="card-footer">
        <small>This form lets you clear out the bill of materials staged for this option and replacce it with the BOM from an existing phantom in Syspro. It will clear out anything already staged. </small>
    </div>
</div>
