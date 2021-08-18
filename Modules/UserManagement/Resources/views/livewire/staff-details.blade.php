<div>
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            Staff Details
        </div>

        <div class="card-body">
            <form wire:submit.prevent="save">


                <div class="row mb-3">
                    <div class="col-3">
                        <label for="first_name" class="col-form-label">First Name</label>
                    </div>
                    <div class="col-9">

                        <input type="text" class="form-control"
                               id="first_name"
                               wire:focusout="save"
                               wire:model.lazy="user.first_name">
                        @error('user.first_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-3">
                        <label for="last_name" class="col-form-label">Last Name</label>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control"
                               id="first_name"
                               wire:focusout="save"
                               wire:model.lazy="user.last_name">
                        @error('user.last_name') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>


                </div>



                <div class="row mb-3">
                    <div class="col-3">
                        <label for="department" class="col-form-label">Department</label>
                    </div>
                    <div class="col-9">
                        <select
                            wire:change="save"
                            id="department"
                            class="form-control"
                            wire:model="user.department_id">
                            @foreach( \App\Models\Department::all() as $department )
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('user.department_id') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>


                </div>





{{--                <div class="row mb-3">--}}
{{--                    <div class="col-3">--}}
{{--                        <label for="email" class="col-form-label">Email Address</label>--}}
{{--                    </div>--}}
{{--                    <div class="col-9">--}}
{{--                        <input type="text" class="form-control"--}}
{{--                               id="email"--}}
{{--                               wire:focusout="save"--}}
{{--                               wire:model.lazy="user.email">--}}
{{--                        @error('user.email') <span class="text-danger">{{ $message }}</span> @enderror--}}

{{--                    </div>--}}


{{--                </div>--}}

{{--            <input type="submit" wire:click="save">--}}


            </form>
        </div>
        <div class="card-footer">
            <small>
                Make the changes you want to the above information, then click the link at the top of the page to go back to the list of staff. Your changes are saved automatically.
            </small>
        </div>
    </div>
</div>
