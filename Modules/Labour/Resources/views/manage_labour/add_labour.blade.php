@php

    $time = \Carbon\Carbon::now("America/Moncton");
    $start_hours = $time->copy()->subHour()->format('g');
    $end_hours = $time->format('g');
    $start_minutes = '00';
    $end_minutes = '00';
    $start_ampm = $time->format('A');
    $end_ampm = $time->copy()->subHour()->format('A');

@endphp
<div class="card border-success sticky-top">

    <div class="card-header bg-success text-white">
        <h4>
            Add Labour for <b>{{ $selected_user->first_name }}  {{ $selected_user->last_name }}</b> on <b>{{ $selected_date }}</b>

            <a class="btn btn-warning btn-sm float-end"
               href="{{ request()->fullUrlWithQuery([
                        'selected_user'=>null,
                        'selected_date'=>null,
                            'labour_id' => null,
                          'form_locked' => false,
                        'mode' =>  null,
                    ]) }}">Cancel</a>


        </h4>

    </div>
    <div class="card-body">


        <form method="POST" action="{{ route('labour.management.add') }}">
            <input type="hidden" name="referer_url" value="{{ request()->fullUrlWithQuery([]) }}">
            <input type="hidden" name="user_id" value="{{ $selected_user->id }}">
            <input type="hidden" name="date" value="{{ $selected_date }}">

            @csrf
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
                            wire:model.defer="labour.department_id"
                            id="department_id"
                            aria-label=""
                    >
                        @foreach( App\Models\Department::all()  as $dept )
                            @if ( $selected_user->department_id == $dept->id)
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
                           wire:model.defer="labour.job"
                           name="job"
                           class="form-control"
                           required
                           placeholder="Search or Pick a Recent Job Below"
                    >
                    @error('labour.job') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Add Labour" class="btn btn-success">
                </div>
            </div>
        </form>


        <hr>


    </div>

</div>

