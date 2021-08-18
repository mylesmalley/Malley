<div class="row">
    <div class="col-12">
        <div class="card border-dark">
            <div class="card-header bg-dark text-light">
                <h4>Change Details</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ url('index/forms/'.($target ?? 'selection').'/edit') }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="form_element_id" id="form_element_id" value="{{ $element->id }}">

                    <div class="row">
                        <div class="col-6">
                            <label for="label">Label</label>
                            <input type="text" id="label"
                                   name="label"
                                   class="form-control"
                                   value="{{ old('label') ?? $element->label }}">
                        </div>

                        <div class="col-3">
                            <label for="indent">Indent</label>
                            <input type="number" id="indent"
                                   name="indent"
                                   class="form-control"
                                   value="{{ old('indent') ?? $element->indent ?? 0 }}">
                        </div>
                        <div class="col-3 ">
                            <input type="submit" value="Save Changes" class="btn btn-primary">
                        </div>
                    </div>

                </form>

                @if( ! $element->items->count() )
                <hr>

                <form method="POST" action="{{ url('index/forms/'.($target ?? 'selection').'/delete') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="form_element_id" id="form_element_id" value="{{ $element->id }}">
                    <input type="submit" value="Delete Empty Form Element" class="btn btn-danger">
                </form>

                @endif
            </div>
        </div>
    </div>
</div>
