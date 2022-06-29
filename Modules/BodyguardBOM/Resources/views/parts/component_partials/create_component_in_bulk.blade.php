<div class="row">
    <div class="col-12">
        <div class="card border-dark">
            <div class="card-header bg-dark text-white">
                {{ $part['description'] }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1">

                        @error('include.'.$id )
                        <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror

                        <label for="include_{{ $id }}"
                               class="form-label">
                            Include?</label>

                        <select class="form-control form-control-sm"
                                name="include[{{ $id }}]"
                                id="include_{{ $id }}">
                            @foreach( [1 => 'Yes', 0 => 'No'] as $k => $v )
                                <option
                                        {{ old('include.'.$id, 1 ) == $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <span id="status_{{ $id }}"></span>

                    </div>
                    <div class="col-2">

                        @error('colour.'.$id )
                        <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror

                        <label for="colour_{{ $id }}"
                               class="form-label">
                            Colour of Material</label>
                        <select class="form-control form-control-sm"
                                name="colour[{{ $id }}]"
                                id="colour_{{ $id }}">
                            <option value=""></option>
                            @foreach( $colours as $k => $v )
                                <option
                                        {{ old('colour.'.$id, $kit->colour ) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">

                        @error('chassis.'.$id )
                        <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror

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
                                                {{ old('chassis.'.$id, request()->input('chassis') ) == $key ? " selected " : ""   }}
                                                value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                                    @endforeach
                                </optgroup>



                            @endforeach
                        </select>
                    </div>


                    <div class="col-2">

                        @error('location.'.$id )
                        <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror
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
                                                {{ old('location.'.$id, request()->input('location') ) == $key ? " selected " : ""   }}
                                                value="{{ $key ?? "aaa" }}">{{ $desc ?? 'bbb' }}</option>
                                    @endforeach
                                </optgroup>



                            @endforeach
                        </select>
                    </div>


                    <div class="col-3">
                        @error('kit_code.'.$id )
                        <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror

                        <label for="kit_code_{{ $id }}"
                               class="form-label">
                            Part Type</label>
                        <select class="form-control form-control-sm"
                                name="kit_code[{{ $id }}]"
                                id="kit_code_{{ $id }}">
                            <option value=""></option>

                            @foreach( $kit_codes as $k => $v )
                                <option
                                        {{ old('kit_code.'.$id, $part['kit_code']) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v['desc'] }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-2">
                        @error('roof_height.'.$id )
                            <span class="text-danger">
                                This field is required
                            </span><br>
                        @enderror
                        <label for="roof_height_{{ $id }}"
                               class="form-label">
                            Roof Height</label>
                        <select class="form-control form-control-sm"
                                name="roof_height[{{ $id }}]"
                                id="roof_height_{{ $id }}">
                            <option value=""></option>

                            @foreach( $roof_heights as $k => $v )
                                <option
                                        {{ old('roof_height.'.$id, request()->input('roof_height')) === $k ? " selected " : ""   }}
                                        value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="offset-1 col-3">
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

                </div>


            </div>
        </div>
    </div>
</div>