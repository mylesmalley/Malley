<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        Editing Time for {{ $user->first_name }} on {{ $labour->start->format('M d') }}
        <a wire:click="cancelManageTime"
           wire:keydown.escape="cancelManageTime"
           class="btn btn-warning btn-sm float-end">
            Cancel
        </a>
    </div>





    <div class="card-body">

        @if ($labour->flagged )
            <p class="text-warning">Looks like this record was flagged. It might be on the wrong job or just made in error. When you click save, the flag will be removed even if you haven't changed anything. </p>
        @endif

        <form wire:submit.prevent="update_record"
              wire:keydown.escape="cancel">


            <div class="form-group row">

                <div class="col-3">
                    <label for="start_time">Start</label>
                </div>

                <div class="col-3">
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                  id="start_hrs">Hr</span>
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
                    <label for="end_time">Department</label>
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
                            {{--                                @if ( $department_id == $dept->id)--}}
                            {{--                                    <option selected>{{ $dept->name }}</option>--}}
                            {{--                                @else--}}
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            {{--                                @endif--}}
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
                           name="job"
                           wire:model="labour.job"
                           class="form-control"
                           required
                           placeholder="Search or Pick a Recent Job Below"
                    >
                    @error('job') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="submit"
                           value="Save Changes To Labour"
                           class="btn btn-primary">
                </div>
            </div>
        </form>



        <hr>

{{--        @livewire('labour::job-search-component', [ $user ])--}}


        <hr>


        <small class="text-danger">If this record is wrong and it isn't worth fixing, you can delete it.</small>

        <button class="btn btn-danger" wire:click="deleteLabourRecord">
            Delete Labour
        </button>

    </div>




</div>