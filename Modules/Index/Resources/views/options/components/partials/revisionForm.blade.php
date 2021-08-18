<div class="card bg-info text-white">
    <div class="card-header">
        Post Changes to Syspro (creates a new revision)
    </div>
    <div class="card-body">
        <form class="row"
              method="POST"
              action="{{ url("/index/option/revisionFromComponentsPage") }}">
            {{ csrf_field() }}
            <input type="hidden" name="option_id" value="{{ $option->id }}">
            <input type="hidden" name="option_name" value="{{ $option->option_name }}">
            <div class="col-3">
                <label  for="engineering_notes">Change Note</label>

            </div>
            <div class="col-9">
                <input type="text"
                       required
                       class="form-control"
                       id="engineering_notes"
                       value=""
{{--                       value="{{ old('engineering_notes') }}"--}}
                       name="engineering_notes"
                       placeholder="Why was this change made?">

            </div>

            <div class="col-9"></div>
            <div class="col-2">
                <input type="submit" class="btn btn-warning" value="Submit">

            </div>


        </form>
    </div>

    <div class="card-footer">
        <small>When you have made changes to the bill of materials and are ready to push to Syspro, enter a reason for the change and submit. A new revision will be created and a new phantom will be generated with these components. </small>
    </div>
</div>
