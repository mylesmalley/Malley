@php

    $time = \Carbon\Carbon::now("America/Moncton");

    $start = \Carbon\Carbon::parse( $labour->start, 'America/Moncton' );
    $end = \Carbon\Carbon::parse( $labour->end , 'America/Moncton' );

    /*
    $start_hours = $time->copy()->subHour()->format('g');
    $end_hours = $time->format('g');
    $start_minutes = '00';
    $end_minutes = '00';
    $start_ampm = $time->format('A');
    $end_ampm = $time->copy()->subHour()->format('A');
*/
@endphp
<div class="card border-primary  m-1">

    <div class="card-header bg-primary text-white">
        <h4>
            Editing Labour for <b>{{ $selected_user->first_name }}  {{ $selected_user->last_name }}</b> on <b>{{ $selected_date }}</b>



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
        @includeIf('app.components.errors')
        <form method="POST" action="{{ route('labour.management.edit') }}">
            <input type="hidden" name="referer_url" value="{{ request()->fullUrlWithQuery([]) }}">
            <input type="hidden" value="{{ $labour->id }}" name="labour_id" id="labour_id">
            <input type="hidden" value="{{ $labour->user_id }}" name="user_id" id="user_id">
            <input type="hidden" value="{{ $selected_date }}" name="date" id="date">
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
                               type="text"
                               aria-label=""
                               value="{{ old("start_hours", $start->format('h')) }}"
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
                               type="text"
                               aria-label=""

                               value="{{ old("start_minutes", $start->format('i')) }}"

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
                        <option {{ $start->format('A') === 'AM' ? 'selected' : '' }}>AM</option>
                        <option {{ $start->format('A') === 'PM' ? 'selected' : '' }}>PM</option>
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
                            <span class="input-group-text">Hr</span>
                        </div>
                        <input id="end_hours"
                               type="text"
                               aria-label=""
                               value="{{ old("end_hours", $end->format('h')) }}"

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
                               type="text"
                               aria-label=""
                               value="{{ old("end_minutes", $end->format('i')) }}"

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

                        <option {{ $end->format('A') === 'AM' ? 'selected' : '' }}>AM</option>
                        <option {{ $end->format('A') === 'PM' ? 'selected' : '' }}>PM</option>
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
                        @foreach( App\Models\Department::orderBy('name')->get()  as $dept )
                            @if ( $labour->department_id == $dept->id)
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
                           value="{{ old('job', $labour->job ) }}"
                           class="form-control"
                           required
                           placeholder="Search or Pick a Recent Job Below"
                    >
                    @error('labour.job') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Save Changes" class="btn btn-success">

                    <br>
                    <small class="text-secondary text-sm">{{ $labour->id }}</small>
                </div>
            </div>
        </form>
        <form   class="text-end"
                action="{{ route('labour.management.delete') }}"
                method="POST">
            @method('DELETE')
            @csrf
            <input type="hidden"
                   class="text-end"
                   name="labour_id"
                   value="{{ $labour->id }}"
                   id="labour_id">
            <input type="hidden"
                   name="date"
                   id="date"
                   value="{{ $selected_user }}">
            <input type="submit"
                   class="text-end btn btn-sm btn-outline-danger"
                   value="DELETE THIS TIME">
        </form>


    </div>

</div>
