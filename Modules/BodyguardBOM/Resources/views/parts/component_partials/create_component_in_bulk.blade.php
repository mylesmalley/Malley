<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ $part['description'] }}
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-2">
                        @error('colour') <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="colour"
                               class="form-label">
                            Colour of Material</label>
                        <select class="form-control form-control-sm"
                                name="colour"
                                id="colour">
                            <option value=""></option>
                            @foreach( $colours as $k => $v )
                                <option
                                        {{ old('colour', $kit->colour ) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">

                        @error('chassis') <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="chassis"
                               class="form-label">
                            Chassis </label>
                        <select class="form-control form-control-sm"
                                name="chassis"
                                id="chassis">
                            <option value=""></option>

                            @foreach( $chassis_list as $van => $options )
                                <optgroup label="{{ $van }}">
                                    @foreach( $options as $key => $desc)
                                        <option
                                                {{ old('chassis', request()->input('chassis') ) == $key ? " selected " : ""   }}
                                                value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                                    @endforeach
                                </optgroup>



                            @endforeach
                        </select>
                    </div>


                    <div class="col-3">

                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="location"
                               class="form-label">
                            Install Location</label>
                        <select class="form-control form-control-sm"
                                name="location"
                                id="location">
                            <option value=""></option>
                            @foreach( $part_locations as $location => $options )
                                <optgroup label="{{ $location }}">
                                    @foreach( $options as $key => $desc)
                                        <option
                                                {{ old('location', request()->input('location') ) == $key ? " selected " : ""   }}
                                                value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                                    @endforeach
                                </optgroup>



                            @endforeach
                        </select>
                    </div>


                    <div class="col-3">
                        @error('kit_code') <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="kit_code"
                               class="form-label">
                            Part Type</label>
                        <select class="form-control form-control-sm"
                                name="kit_code"
                                id="kit_code">
                            <option value=""></option>

                            @foreach( $kit_codes as $k => $v )
                                <option
                                        {{ old('kit_code', $part['kit_code']) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v['desc'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-2">
                        @error('roof_height') <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="roof_height"
                               class="form-label">
                            Roof Height</label>
                        <select class="form-control form-control-sm"
                                name="roof_height"
                                id="roof_height">
                            <option value=""></option>

                            @foreach( $roof_heights as $k => $v )
                                <option
                                        {{ old('roof_height', request()->input('roof_height')) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>




            </div>
        </div>
    </div>
</div>