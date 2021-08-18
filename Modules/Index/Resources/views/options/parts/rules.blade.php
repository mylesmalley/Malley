<div class="col-md-6">
    <div class="card border-primary ">
        <div class="card-header bg-primary text-white">Rules for {{ $option->option_name }}

            @if( Auth::user()->can_edit_options )

                <a href="{{ url('/index/option/'.$option->id.'/rules') }}"
                   class='btn btn-sm btn-secondary float-end'>Edit</a>

            @endif
        </div>


        <table class="table table-sm table-hover table-striped">
            <thead >
            <tr>
{{--                <th>ID</th>--}}
                <th>Option</th>
                <th>Rule</th>
            </tr>
            </thead>
            <tbody>
            @php
                $ruleTypes = \App\Models\OptionRule::ruleTypes();
            @endphp
            @foreach( $option->rules as $rule )
                <tr>
{{--                    <td>{{ $rule->id }}</td>--}}
                    <td><a href="/index/option/{{ $rule->relatedOption->id }}/home">
                            {{ $rule->relatedOption->fullName }} </a><br />{{ $rule->relatedOption->option_description }}</td>
                    <td>
                    <span
                            @switch($rule->rule_type)
                            @case("CANT")
                            class="text-danger"
                            @break

                            @case("MUST")
                            class="text-success"
                            @break

                            @case("ONEA")
                            class="text-info"
                            @break

                            @default
                            class=""
                                @endswitch
                        >

                            {{ $ruleTypes[$rule->rule_type] }} With This

                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
</div>


    <div class="col-md-6">
        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">Rules Dealing with {{ $option->fullName }}

            @if( Auth::user()->can_edit_options )

                <a href="{{ url('/index/option/'.$option->id.'/rules') }}"
                   class='btn btn-sm btn-secondary float-end'>Edit</a>

            @endif
        </div>
        <table class="table table-sm table-hover table-striped">
            <thead>
            <tr>
{{--                <th>ID</th>--}}
                <th>Rule</th>
                <th>Option</th>
            </tr>
            </thead>
            <tbody>
            @php
                $ruleTypes = \App\Models\OptionRule::ruleTypes();
            @endphp
            @foreach( $option->relatedRules as $rule )
                <tr

                >
{{--                    <td>{{ $rule->id }}</td>--}}
                    <td>
                        <span
                                @switch($rule->rule_type)
                                @case("CANT")
                                class="text-danger"
                                @break

                                @case("MUST")
                                class="text-success"
                                @break

                                @case("ONEA")
                                class="text-info"
                                @break

                                @default
                                class=""
                                @endswitch
                        >

                          This  {{ $ruleTypes[$rule->rule_type] }} with

                        </span>



                        </td>
                    <td><a href="/index/option/{{ $rule->option->id }}/home">
                            {{ $rule->option->fullName }} </a><br />{{ $rule->option->option_description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
