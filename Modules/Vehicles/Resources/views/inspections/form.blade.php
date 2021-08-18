

    {{ csrf_field() }}

    <div class="row">


        <div class="form-group col-sm-12">
            <label for="description">Description</label>
            <input type="text"
                   id="description"
                   name="description"
                   required
                   class="form-control"
                   value="{{ old('description') ?? $inspection->description  ?? '' }}"
            >
        </div>


        <div class="form-group col-sm-2">
            <label for="life_step">Category</label>
            <select name="life_step" id="life_step" class="form-control">
                @foreach( ['Inspection','Warranty'] as $life_step )
                    @if( $inspection->life_step === $life_step || old('life_step') === $life_step )
                        <option selected>{{ $life_step }}</option>
                    @else
                        <option>{{ $life_step }}</option>
                    @endif
                @endforeach
            </select>
        </div>



        <div class="form-group col-sm-2">
            <label for="location">Location</label>
            <select name="location" id="location" class="form-control">
                @foreach( $inspection::locations() as $location )
                    @if( $inspection->location === $location || old('location') === $location )
                        <option selected>{{ $location }}</option>
                    @else
                        <option>{{ $location }}</option>
                    @endif
                @endforeach
            </select>
        </div>



        <div class="form-group col-sm-2">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                @foreach( $inspection::types() as $type )
                    @if( $inspection->type === $type || old('type') === $type )
                        <option selected>{{ $type }}</option>
                    @else
                        <option>{{ $type }}</option>
                    @endif
                @endforeach
            </select>
        </div>



        <div class="form-group col-sm-2">
            <label for="source">Sources</label>
            <select name="source" id="source" class="form-control">
                @foreach( $inspection::sources() as $source )
                    @if( $inspection->source === $source || old('source') === $source )
                        <option selected>{{ $source }}</option>
                    @else
                        <option>{{ $source }}</option>
                    @endif
                @endforeach
            </select>
        </div>



        <div class="form-group col-sm-2">
            <label for="severity">Severity</label>
            <select name="severity" id="severity" class="form-control">
                @foreach( ['N/A','HIGH','MEDIUM','LOW'] as $severity )
                    @if( $inspection->severity === $severity || old('severity') === $severity )
                        <option selected>{{ $severity }}</option>
                    @else
                        <option>{{ $severity }}</option>
                    @endif
                @endforeach
            </select>
        </div>


    </div>

    <div class="row">

        <div class="form-group ">
            &nbsp;
            <input id="sub"
                   type="submit"
                   style="margin-top:2em !important;"
                   value="Save Inspection"
                   class="btn btn-secondary align-bottom">

        </div>

    </div>

