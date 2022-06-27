<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ $part['description'] }}
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-2">
                        @error('colour_'. $id ) <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="colour_{{ $id }}"
                               class="form-label">
                            Colour of Material</label>
                        <select class="form-control form-control-sm"
                                name="colour[{{ $id }}]"
                                id="colour_{{ $id }}">
                            <option value=""></option>
                            @foreach( $colours as $k => $v )
                                <option
                                        {{ old('colour', $kit->colour ) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">

                        @error('chassis_'. $id ) <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="chassis_{{ $id }}"
                               class="form-label">
                            Chassis </label>
                        <select class="form-control form-control-sm"
                                name="chassis[{{ $id }}]"
                                id="chassis_{{ $id }}">
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

                        @error('location_'. $id ) <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="location_{{ $id }}"
                               class="form-label">
                            Install Location</label>
                        <select class="form-control form-control-sm"
                                name="location[{{ $id }}]"
                                id="location_{{ $id }}">
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
                        @error('kit_code_'. $id ) <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="kit_code_{{ $id }}"
                               class="form-label">
                            Part Type</label>
                        <select class="form-control form-control-sm"
                                name="kit_code[{{ $id }}]"
                                id="kit_code_{{ $id }}">
                            <option value=""></option>

                            @foreach( $kit_codes as $k => $v )
                                <option
                                        {{ old('kit_code', $part['kit_code']) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v['desc'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-2">
                        @error('roof_height_'. $id ) <span class="text-danger">{{ $message }}</span> @enderror
                        <label for="roof_height_{{ $id }}"
                               class="form-label">
                            Roof Height</label>
                        <select class="form-control form-control-sm"
                                name="roof_height[{{ $id }}]"
                                id="roof_height_{{ $id }}">
                            <option value=""></option>

                            @foreach( $roof_heights as $k => $v )
                                <option
                                        {{ old('roof_height', request()->input('roof_height')) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-4">
                        <label for="part_number_{{ $id }}"
                               class="form-label">
                            Part Number</label>
                        <input class="form-control form-control-sm"
                                name="part_number[]"
                               readonly
                               id="part_number_{{ $id }}">
                    </div>
                    <div class="col-6">
                        <label for="description_{{ $id }}"
                               class="form-label">
                            Description</label>
                        <input class="form-control form-control-sm"
                               name="description[]"
                               id="description_{{ $id }}">
                    </div>
                    <div class="col-4">
                        <span id="status_{{ $id }}"></span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>