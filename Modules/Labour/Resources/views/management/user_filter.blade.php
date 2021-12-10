<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a href="{{ route('labour.management.home', ['filter'=>'all']) }}"
                        class="nav-link {{ $activeTab === 'all' ? 'active' : 'bg-secondary text-white' }}"
                   >All Staff By Date</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ $activeTab === 'department' ? 'active' : 'bg-secondary text-white' }}"
                   href="{{ route('labour.management.home', ['filter'=>'department']) }}"
                >By Department</a>
            </li>
            <li class="nav-item" >
                <a href="{{ route('labour.management.home', ['filter'=>'person']) }}"
                   class="nav-link {{ $activeTab === 'person' ? 'active' : 'text-white bg-secondary ' }}" >By Person and Dates</a>
            </li>

{{--            <li class="nav-item" wire:click="setTab('flagged')">--}}
{{--                <a class="nav-link {{ $activeTab === 'flagged' ? 'active' : 'text-white bg-secondary ' }}" >Flagged By Date</a>--}}
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




        @if ( $activeTab === 'all' )

            <form class="row row-cols-lg-auto g-3 align-items-center"
                  action="{{ route('labour.management.home') }}"
                  method="GET">
                <input type="hidden" name="filter" value="all">
                @csrf
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text">Date</div>
                        <input type="date"
                               aria-label=""
                               value="{{ $dates[0] }}"
                               name="start"
                               max="{{ date('Y-m-d') }}"
                               class="form-control"
                               id=""
                               placeholder="date">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Go</button>
                </div>
            </form>


        @endif
        @if ( $activeTab === 'department' )

                <form class="row row-cols-lg-auto g-3 align-items-center"
                      action="{{ route('labour.management.home') }}"
                      method="GET">
                    <input type="hidden" name="filter" value="department">
                    @csrf
                <div class="col-12">
                    <div class="input-group">
                        <div class="input-group-text">Date</div>
                        <input type="date"
                               aria-label=""
                               name="start"
                               max="{{ date('Y-m-d') }}"
                               value="{{ $dates[0] }}"
                               class="form-control"
                               id="date"
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
                            @if ( session('selected_department_id') == $dept->id)
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
            @if ( $activeTab === 'person' )

                <form class="row row-cols-lg-auto g-3 align-items-center"
                      wire:submit.prevent="byPersonByDateRange">

                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-text">From </div>
                            <input type="date"
                                   aria-label=""
                                   max="{{ date('Y-m-d') }}"
                                   wire:model="by_person_start_date"
                                   class="form-control" id="by_person_start_date" placeholder="date">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group">
                            <div class="input-group-text">To</div>
                            <input type="date"
                                   aria-label=""
                                   max="{{ date('Y-m-d') }}"
                                   wire:model="by_person_end_date"
                                   class="form-control" id="by_person_end_date" placeholder="date">
                        </div>
                    </div>

                    <div class="col-12">
                        <select class="form-select"
                                aria-label=""
                                wire:model="by_person_user_id"
                                id="by_person_user_id">
                            @foreach( \App\Models\User::role('labour')
                                        ->where('is_enabled', true )
                                        ->orderBy('last_name')
                                        ->get()  as $user )
                                @if ( session('by_person_user_id') == $user->id)
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






{{--            @if ( $activeTab === 'flagged' )--}}

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
