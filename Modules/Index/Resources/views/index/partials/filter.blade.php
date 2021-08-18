@php

    $sort_column_options = [
        'option_name' => "Option Name",
        'option_description' => "Description",
        "updated_at" => "Date last updated",
        "created_at" => "Date created",
    ];

@endphp



<div class="d-flex justify-content-between">
    <div class="p-2">

        <form method="POST"
              class="form-inline"
              action="{{ '/vehicles/search' }}">
            {{ csrf_field() }}

            {{--    <div class="form-group input-group-lg">--}}


            {{--        <div class="input-group-addon">--}}
            &nbsp;



            <label class="" for="filter">Filter</label>
            &nbsp;

            <select class="custom-select"
                    id="filter"
                    name="filter">
                <option value="null">
{{--                        {{ !request('filter') || old('filter') == 'null' ? 'selected' : '' }}>--}}
                    Show All
                </option>
                @foreach( $categories as $key => $value )
                    <option
                            {{ request('filter') == $key || old('filter') == $key ? 'selected' : '' }}
                            value="{{ $key }}">{!!  $value !!}</option>
                @endforeach
            </select>
            &nbsp;

            <label class="" for="sort">Sort By</label>
            &nbsp;

            <select class="custom-select"
                    id="sort"
                    name="sort">

                @foreach( $sort_column_options as $key => $value )
                    <option
                            {{ request('sort') === $key || old('sort') === $key ? 'selected' : '' }}
                            value="{{ $key }}">{!!  $value !!}</option>
                @endforeach
            </select>            &nbsp;


            <select class="custom-select"
                    id="order"
                    name="order"
                    aria-label="">

                @foreach( ['ASC' => "Ascending", 'DESC'=>'Descending'] as $key => $value )
                    <option
                            {{ request('order') === $key || old('order') === $key ? 'selected' : '' }}
                            value="{{ $key }}">{!!  $value !!}</option>
                @endforeach
            </select>

            &nbsp;
            <a href="{{ url('index/preferences') }}" class="btn btn-outline-dark btn-light">Options</a>



            <script>

                function buildUrl(  )
                {
                    let filter = document.getElementById('filter').value;
                    let sort = document.getElementById('sort').value;
                    let order = document.getElementById('order').value;

                    window.location.href = `{{ url("index/basevan/{$basevan->id}") }}?filter=${filter}&sort=${sort}&order=${order}`;
                }

                document.getElementById('filter')
                    .addEventListener('change', function(){
                        buildUrl();
                    });

                document.getElementById('sort')
                    .addEventListener('change', function(){
                        buildUrl();
                    });

                document.getElementById('order')
                    .addEventListener('change', function(){
                        buildUrl();
                    });

            </script>





        </form>


    </div>
    <div class="p-2">
        @if( Auth::user()->can_edit_options )

        <a href="{{ url('/index/basevan/'.$basevan->id.'/create') }}" class="btn float-right
    btn-outline-success btn-light">New Option</a>
        @endif
    </div>
</div>







