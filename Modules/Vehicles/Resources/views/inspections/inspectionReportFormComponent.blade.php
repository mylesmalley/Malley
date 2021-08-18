<form method="GET"  action="{{ route('inspection.report') }}">
    {{--        @csrf--}}

    <div class="d-screen">
        <h2 class="text-secondary text-center">{{ request()->start_date ?? \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }} to
            {{ request()->end_date ?? date("Y-m-d") }}
        </h2>
    </div>

    <div class="row d-print-none">


        <div class="col-3">
            <label class="sr-only" for="start_date">Start Date</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">Start</div>
                </div>
                <input type="date"
                       class="form-control"
                       required
                       value="{{ request()->start_date ?? \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}"
                       name="start_date"
                       id="start_date">
            </div>
        </div>

        <div class="col-3">
            <label class="sr-only" for="end_date">End Date?</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">End</div>
                </div>
                <input type="date"
                       required
                       name="end_date"
                       class="form-control"
                       value="{{ request()->end_date ?? date('Y-m-d') }}"
                       id="end_date">
            </div>
        </div>

        <div class="col-3">
            <label class="sr-only" for="column">Column</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">Sort By</div>
                </div>
                <select name="column" id="column" class="form-control">
                    @foreach([
                        "date_entered" => "Date",
                        "type" => "Type",
                        "source" => "Source",
                        "location" => "Location",
                        'severity' => 'Severity',

                    ] as $column => $label)
                        <option
                            @if ( request()->has('column') && request()->column === $column )
                            selected
                            @endif
                            value="{{ $column }}">{{ $label }}</option>
                    @endforeach
                </select>

            </div>
        </div>




        <div class="col-3">
            <label class="sr-only" for="column">Order</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">Order</div>
                </div>
                <select name="order" id="order" class="form-control">
                    @foreach([
                        "asc" => "Ascending",
                        "desc" => "Descending",
                    ] as $order => $label)
                        <option
                            @if ( request()->has('order') && request()->order === $order )
                            selected
                            @endif
                            value="{{ $order }}">{{ $label }}</option>
                    @endforeach
                </select>

            </div>
        </div>

    </div>


</form>
