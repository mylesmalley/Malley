<div class="row text-center">
    <div class='col-md-12'>
        <h1 class="display-4">Seating</h1>
    </div>
</div>

<div class="row text-center">
    <div class="col-md-12">
        <h3>Cab Seating</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Seat</th>
                <th>Distance from Front Axel</th>
                <th>Distance from Passenger Wheels</th>
                <th>Has Passenger</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>

            @for( $i = 1; $i <= 3; $i++ )
                <tr>

                    @php
                        $axel = "cab_seat_{$i}_axel";
                        $wheel = "cab_seat_{$i}_wheel";
                        $used = "cab_seat_{$i}_used";
                        $desc = "cab_seat_{$i}_desc";
                    @endphp
                    <td>
                        Seat {{ $i }}
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $axel }}"
                                   name="{{ $axel }}"
                                   value="{{ old( $axel ) ?? $vehicle->$axel ?? "" }}"
                                   id="{{ $axel }}"
                                   class="form-control">
                            <span class="input-group-text" title='Inches'>in</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $wheel }}"
                                   name="{{ $wheel }}"
                                   value="{{ old( $wheel ) ?? $vehicle->$wheel ?? "" }}"
                                   id="{{ $wheel }}"
                                   class="form-control">
                            <span class="input-group-text" title='Inches'>in</span>
                        </div>
                    </td>
                    <td>
                        <select aria-label=""
                                class="form-control"
                                name="{{ $used }}"
                                id="{{ $used }}">
                            <option
                                @if( old( $used ) == false || $vehicle->$used == false )
                                selected
                                @endif
                                value="0"></option>
                            <option
                                @if( old( $used ) == true || $vehicle->$used == true)
                                selected
                                @endif
                                value="1">Yes</option>


                        </select>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $desc }}"
                                   name="{{ $desc }}"
                                   value="{{ old( $desc ) ?? $vehicle->$desc ?? "" }}"
                                   id="{{ $desc }}"
                                   class="form-control">
                        </div>
                    </td>
                </tr>

            @endfor
            </tbody>
        </table>
    </div>
</div>




<div class="row text-center">
    <div class="col-md-12">
        <h3>Rear (Patient) Seating</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Seat</th>
                <th>Distance from Front Axel</th>
                <th>Distance from Passenger Wheels</th>
                <th>Has Passenger</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>

            @for( $i = 1; $i <= 16; $i++ )
                <tr>

                    @php
                        $axel =  "passenger_seat_{$i}_axel";
                        $wheel = "passenger_seat_{$i}_wheel";
                        $used =  "passenger_seat_{$i}_used";
                        $desc =  "passenger_seat_{$i}_desc";
                    @endphp
                    <td>
                        Seat {{ $i }}
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $axel }}"
                                   name="{{ $axel }}"
                                   value="{{ old( $axel ) ?? $vehicle->$axel ?? "" }}"
                                   id="{{ $axel }}"
                                   class="form-control">
                            <span class="input-group-text" title='Inches'>in</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $wheel }}"
                                   name="{{ $wheel }}"
                                   value="{{ old( $wheel ) ?? $vehicle->$wheel ?? "" }}"
                                   id="{{ $wheel }}"
                                   class="form-control">
                            <span class="input-group-text" title='Inches'>in</span>
                        </div>
                    </td>
                    <td>
                        <select aria-label=""
                                class="form-control"
                                name="{{ $used }}"
                                id="{{ $used }}">
                            <option
                                @if( old( $used ) == false || $vehicle->$used == false )
                                selected
                                @endif
                                value="0"></option>
                            <option
                                @if( old( $used ) == true || $vehicle->$used == true)
                                selected
                                @endif
                                value="1">Yes</option>


                        </select>
{{--                        <select aria-label=""--}}
{{--                                class="form-control"--}}
{{--                                name="{{ $used }}"--}}

{{--                                id="{{ $used }}">--}}
{{--                            <option value="0">No</option>--}}
{{--                            <option value="1">Yes</option>--}}

{{--                        </select>--}}
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="text"
                                   aria-label="{{ $desc }}"
                                   name="{{ $desc }}"
                                   value="{{ old( $desc ) ?? $vehicle->$desc ?? "" }}"
                                   id="{{ $desc }}"
                                   class="form-control">
                        </div>
                    </td>
                </tr>

            @endfor
            </tbody>
        </table>
    </div>
</div>

