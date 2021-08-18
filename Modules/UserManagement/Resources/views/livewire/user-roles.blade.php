<div>
    @if ( $user->is_enabled )

    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            User Roles and Permissions
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    Roles
                    <ul>


                    @foreach( $roles as $role )
                        <li
                                @if ($user->hasRole( $role ))
                                    class="text-success"
                                @endif
                                wire:click="toggleRole('{{ $role }}')">
                                {{ ucwords( str_replace( '_',' ', $role) ) }}
                            @if ($user->hasRole( $role ))
                                <img src="{{ mix('img/checkmark.png') }}" alt="yes" width="20" >
                                @endif
                            </li>

                    @endforeach
                    </ul>

                </div>

                <div class="col-6">
                    This user can
                    <ul>
                        @foreach( $permissions as $permission )
                            <li>{{ ucwords( str_replace( '_',' ', $permission->name) ) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <button
                wire:click="disableAccount()"
                class="btn btn-lg btn-danger"> DISABLE THIS USER ACCOUNT</button>
        </div>
    </div>

    @else
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                User Disabled
            </div>
            <div class="card-body">
                This user nas no access to any restricted part of the site.
            </div>
            <div class="card-footer text-center">
                <button
                    wire:click="enableAccount()"
                    class="btn btn-lg btn-success"> (Re-) Enable This User Account</button>
            </div>
        </div>

    @endif

</div>
