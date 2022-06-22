<div class="card bg-secondary text-white">
    <div class="card-header">
        Add Component
        <a href="{{ url('/syspro/inventoryQuery/search') }}"
           target="_blank"
           class='btn btn-sm btn-info float-end'>Search Syspro</a>

    </div>
    <div class="card-body">
        <form class="row"
              method="POST"
              action="{{ route('bg.kits.components.add', $kit->id) }}">

                {{ csrf_field() }}
            <div class="col-1">
                <label or="stock_code">Part</label>

            </div>
            <div class="col-5">
                <input type="text"
                       required
                       class="form-control"
                       id="stock_code"
                       value="{{ old('stock_code') }}"
                       name="stock_code"
                       placeholder="stock code">
            </div>

            <div class="col-1">
                <label  for="quantity">QTY</label>

            </div>
            <div class="col-3">
                <input type="text"
                       required
                       value="{{ old('quantity') }}"
                       name="quantity"
                       class="form-control"
                       id="quantity"
                       placeholder="1">
            </div>
            <div class="col-2">
                <input type="submit" class="btn btn-success" value="Add">

            </div>


        </form>
    </div>
</div>
