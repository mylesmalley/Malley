<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a href="{{ route('labour.management.home', ['active_tab'=>'all']) }}"
                        class="nav-link {{ $active_tab === 'all' ? 'active' : 'bg-secondary text-white' }}"
                   >All Staff By Date</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ $active_tab === 'department' ? 'active' : 'bg-secondary text-white' }}"
                   href="{{ route('labour.management.home', ['active_tab'=>'department']) }}"
                >By Department</a>
            </li>
            <li class="nav-item" >
                <a href="{{ route('labour.management.home', ['active_tab'=>'person']) }}"
                   class="nav-link {{ $active_tab === 'person' ? 'active' : 'text-white bg-secondary ' }}" >By Person and Dates</a>
            </li>

{{--            <li class="nav-item" wire:click="setTab('flagged')">--}}
{{--                <a class="nav-link {{ $active_tab === 'flagged' ? 'active' : 'text-white bg-secondary ' }}" >Flagged By Date</a>--}}
{{--            </li>--}}
        </ul>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        @if ( $active_tab === 'all' )

            <form class="row row-cols-lg-auto g-3 align-items-center"
                  action="{{ route('labour.management.home') }}"
                  method="GET">
                <input type="hidden" name="active_tab" value="all">
                @csrf
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text">Date</div>
                        <input type="date"
                               aria-label=""
                               value="{{ $start_date }}"
                               name="start_date"
                               max="{{ date('Y-m-d') }}"
                               class="form-control"
                               id="start_date"
                               placeholder="date">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
            </form>


        @endif
        @if ( $active_tab === 'department' )

                <form class="row row-cols-lg-auto g-3 align-items-center"
                      action="{{ route('labour.management.home') }}"
                      method="GET">
                    <input type="hidden" name="active_tab" value="department">
                    @csrf
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text">Date</div>
                        <input type="date"
                               aria-label=""
                               name="start_date"
                               max="{{ date('Y-m-d') }}"
                               value="{{ $start_date }}"
                               class="form-control"
                               id="start_date"
                               placeholder="Username">
                    </div>
                </div>

                <div class="col-12">
                    <select class="form-select"
                            aria-label=""
                            name="department"
                            id="department">
                        @foreach( App\Models\Department::all()  as $dept )
{{--                            @foreach( App\Models\Department::whereNotIn('id', [1,2,8,9])->get()  as $dept )--}}
                            @if ( $department == $dept->id)
                                <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                            @else
                                <option value="{{ $dept->id }}" >{{ $dept->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
            </form>

            @endif
            @if ( $active_tab === 'person' )

                <form class="row row-cols-lg-auto g-3 align-items-center"
                      action="{{ route('labour.management.home') }}"
                      method="GET">
                    <input type="hidden" name="active_tab" value="person">
                    @csrf
                    <div class="col-4">

                        <div class="input-group">
                            <div class="input-group-text">Start</div>
                            <input type="date"
                                   aria-label=""
                                   value="{{ $start_date }}"
                                   name="start_date"
                                   max="{{ date('Y-m-d') }}"
                                   class="form-control"
                                   id="start_date"
                                   placeholder="date">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <div class="input-group-text">End</div>
                            <input type="date"
                                   aria-label=""
                                   value="{{ $end_date ?? $start_date }}"
                                   name="end_date"
                                   max="{{ date('Y-m-d') }}"
                                   class="form-control"
                                   id="end_date"
                                   placeholder="date">
                        </div>
                    </div>

                    <div class="col-4">
                        <select class="form-select"
                                aria-label=""
                                name="user_id"
                                id="user_id">
                            @foreach( \App\Models\User::role('labour')
                                        ->where('is_enabled', true )
                                        ->orderBy('last_name')
                                        ->get()  as $user )
                                @if ( $user_id == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ $user->first_name . ' ' . $user->last_name }}</option>
                                @else
                                    <option value="{{ $user->id }}" >{{ $user->first_name . ' ' . $user->last_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Go</button>
                    </div>
                </form>
            @endif






{{--            @if ( $active_tab === 'flagged' )--}}

{{--                <form class="row row-cols-lg-auto g-3 align-items-center"--}}
{{--                      wire:submit.prevent="flaggedByDate">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-text">Date</div>--}}
{{--                            <input type="date"--}}
{{--                                   aria-label=""--}}
{{--                                   max="{{ date('Y-m-d') }}"--}}
{{--                                   wire:model="all_staff_date"--}}
{{--                                   class="form-control"--}}
{{--                                   id="inlineFormInputGroupUsername"--}}
{{--                                   placeholder="">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-12">--}}
{{--                        <button type="submit" class="btn btn-primary">Go</button>--}}
{{--                    </div>--}}
{{--                </form>--}}


{{--            @endif--}}







    </div>
</div>
