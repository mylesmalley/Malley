<div class="card border-success sticky-top">


        <div class="card-header bg-success text-white">
            <h4>
                Add Labour for <b>{{ $user->first_name }}  {{ $user->last_name }}</b> on <b>{{ $date->format('M d') }}</b>
                <a wire:click="cancel"  wire:keydown.escape="cancel" class="btn btn-warning btn-sm float-end">Cancel</a>

            </h4>

        </div>
        <div class="card-body">


            <form wire:submit.prevent="addLabour">
                <div class="form-group row">
                    <div class="col-3">
                        <label for="start_time">Start</label>
                    </div>
                    <div class="col-3">
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="start_hrs">Hr</span>
                            </div>
                            <input id="start_hours"
                                   type="number"
                                   aria-label=""
                                   min="1"
                                   max="12"
                                   wire:model="start_hours"
                                   step="1"
                                   class="form-control form-control-sm"
                                   name="start_hours">
                            @error('start_hours') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>
                    <div class="col-3">
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="start_mins">Min</span>
                            </div>
                            <input id="start_minutes"
                                   type="number"
                                   aria-label=""
                                   min="0"
                                   max="59"
                                   wire:model="start_minutes"
                                   step="1"
                                   class="form-control form-control-sm"
                                   name="start_minutes">
                            @error('start_minutes') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>
                    <div class="col-3">
                        <select
                                aria-label=""
                                class="form-control"
                                name="start_ampm"
                                wire:model="start_ampm"
                                id="start_ampm">
                            <option {{ $start_ampm === 'AM' ? 'selected' : '' }}>AM</option>
                            <option {{ $start_ampm === 'PM' ? 'selected' : '' }}>PM</option>
                        </select>


                    </div>


                </div>





                <div class="form-group row">
                    <div class="col-3">
                        <label for="end_time">End </label>
                    </div>
                    <div class="col-3">
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="end_hrs">Hr</span>
                            </div>
                            <input id="end_hours"
                                   type="number"
                                   aria-label=""
                                   wire:model="end_hours"
                                   min="1"
                                   max="12"
                                   step="1"
                                   class="form-control form-control-sm"
                                   name="end_hours">
                            @error('end_hours') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>
                    <div class="col-3">
                        <div class="input-group">

                            <div class="input-group-prepend">
                                <span class="input-group-text" id="end_mins">Min</span>
                            </div>
                            <input id="end_minutes"
                                   type="number"
                                   aria-label=""
                                   wire:model="end_minutes"
                                   min="0"
                                   max="59"
                                   step="1"
                                   class="form-control form-control-sm"
                                   name="end_minutes">
                            @error('end_minutes') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>

                    </div>
                    <div class="col-3">
                        <select
                                aria-label=""
                                class="form-control"
                                name="end_ampm"
                                wire:model="end_ampm"
                                id="end_ampm">

                            <option {{ $end_ampm === 'AM' ? 'selected' : '' }}>AM</option>
                            <option {{ $end_ampm === 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                        @error('end_ampm') <span class="text-danger">{{ $message }}</span> @enderror


                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-3">
                        <label for="end_time">Department </label>
                    </div>
                    <div class="col-9">
                        <select
                                class="form-control"
                                name="department_id"
                                wire:model="labour.department_id"
                                id="department_id"
                                aria-label=""
                        >
                            @foreach( App\Models\Department::all()  as $dept )
                                @if ( $user->department_id == $dept->id)
                                    <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                                @else
                                    <option value="{{ $dept->id }}" >{{ $dept->name }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-3">
                        <label for="job">Job</label>
                    </div>
                    <div class="col-9">
                        <input type="text"
                               readonly
                               id="job"
                               wire:model="labour.job"
                               name="job"
                               class="form-control"
                               required
                               placeholder="Search or Pick a Recent Job Below"
                        >
                        @error('job') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <input type="submit" value="Add Labour" class="btn btn-success">
                    </div>
                </div>
            </form>


            <hr>

            @livewire('labour::job-search-component', [ $user ])

        </div>

</div>
