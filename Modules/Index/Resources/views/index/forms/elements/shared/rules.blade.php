
<div class="row">
    <div class="col-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h4>Rules </h4>


                <div class="d-flex justify-content-between">
                    <div class="p-2">

                        <form>

                            <label class="" for="rulefilter">Filter</label>
                            &nbsp;
                            <select class="custom-select"
                                    id="rulefilter"
                                    name="rulefilter">
                                <option value="0">
                                    Show All
                                </option>
                                @foreach( $categories as $key => $value )
                                    <option
                                            {{ request('filter') == $key || old('filter') == $key ? 'selected' : '' }}
                                            value="{{ $key }}">{!!  $value !!}</option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;


                            <script>

                                function rulefilter(  )
                                {
                                    let filter = document.getElementById('rulefilter').value;
                                    if ( filter === '0')
                                    {
                                        window.location.href = `{{ url("/index/forms/selection/{$element->id}") }}`;
                                    }
                                    else
                                    {
                                        window.location.href = `{{ url("/index/forms/selection/{$element->id}") }}?filter=${filter}`;
                                    }
                                }

                                document.getElementById('rulefilter')
                                    .addEventListener('change', function(){
                                        rulefilter();
                                    });
                            </script>





                        </form>

                    </div>

                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-6">
                        <h3>Existing Rules</h3>
                        <table class="table table-striped">
                            <tbody>
                            @foreach( $existingRules as $rule )
                                <tr>
                                    <td><a href="{{ url('/index//option/'.$rule->id .'/home') }}">{{ $rule->option_name }}</a></td>
                                    <td> {{ $rule->option_description  }}</td>
                                    <td>
                                        <form
                                                method="POSt"
                                                action="{{ url('/index/forms/rules/') }}"
                                                class="form-inline">
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="form_element_id" value="{{ $element->id }}">
                                            <input type="hidden" name="option_name" value="{{ $rule->option_name   }}">
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-outline-danger" value="Remove" >
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>



                    <div class="col-6">
                        <h3>Add Rule</h3>
                        <table class="table table-striped">
                            <tbody>
                            @foreach( $availableRules as $rule )
                                <tr>
                                    <td><a href="{{ url('index/option/'.$rule->id .'/home') }}">{{ $rule->option_name }}</a></td>
                                    <td> {{ $rule->option_description  }}</td>

                                    <td>
                                        <form
                                                method="POSt"
                                                action="{{ url('/index/forms/rules/') }}"
                                                class="form-inline">
                                            <input type="hidden" name="form_element_id" value="{{ $element->id }}">
                                            <input type="hidden" name="option_name" value="{{ $rule->option_name   }}">
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-outline-success" value="Add" >
                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
