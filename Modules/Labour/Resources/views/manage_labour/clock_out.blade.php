<div class="card border-success m-1">

    <div class="card-header bg-info text-white">
        <h4>
            Clock Out <b>{{ $selected_user->first_name }}  {{ $selected_user->last_name }}</b> on <b>{{ $selected_date }}</b>

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

        </form>


    </div>


</div>
