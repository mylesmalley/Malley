@extends('index::app.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1> {{ $element->label }} Quantity List ( # wanted )
                <a href="{{ url('/index/basevan/'.$basevan->id.'/forms/'.$form->id) }}" class="btn float-right btn-dark btn-lg">Back to {{ $form->name  }}</a>

            </h1>
            <h3 class="text-secondary">{{ $form->name }} Form</h3>
            <h3 class="text-secondary">{{ $basevan->name }}</h3>
        </div>
    </div>

    @includeIf('app.components.success')
    @includeIf('app.components.errors')

    @includeIf('index::index.forms.elements.shared.element_details_form',['target'=>'quantity'])


    <br>

    <div class="row">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h4>Existing Options (Each can be on or off)</h4>
                </div>

                <table class="table table-striped">
                    <tbody>
                        @foreach($element->items->sortBy('position') as $item)
                            <tr>
                                <td>YES / NO</td>
                                <td><a href="{{ url('index/option/'.$item->option->id .'/home') }}">{{ $item->option->option_name }}</a></td>
                                <td>{{ $item->option->option_description }}</td>
                                <td>
                                    <form
                                            method="POSt"
                                            action="{{ url('index/forms/quantity/') }}"
                                            class="form-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <label for="position">Position </label>
                                        <input
                                                type="number"
                                                name="position"
                                                id="position"
                                                class="form-control"
                                                value="{{ $item->position }}"
                                                size="4"
                                                min="0" step="1" max="{{ $count+1 }}">
                                        <input type="submit" class="btn btn-outline-info" value="Move">
                                    </form>
                                </td>
                                <td>
                                    <form
                                            method="POSt"
                                            action="{{ url('index/forms/quantity/') }}"
                                            class="form-inline">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" class="btn btn-outline-danger" value="Remove">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<br>



    <div class="row">
        <div class="col-12">
            <div class="card border-info">
                <div class="card-header bg-info text-white">
                    <h4>Available Options </h4>


                    <div class="d-flex justify-content-between">
                        <div class="p-2">

                            <form>
                                <label class="" for="filter">Filter</label>
                                &nbsp
                                <select class="custom-select"
                                        id="filter"
                                        name="filter">
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

                                    function buildUrl(  )
                                    {
                                        let filter = document.getElementById('filter').value;
                                        if ( filter === '0')
                                        {
                                            window.location.href = `{{ url("index/forms/quantity/{$element->id}") }}`;
                                        }
                                        else
                                        {
                                            window.location.href = `{{ url("index/forms/quantity/{$element->id}") }}?filter=${filter}`;
                                        }
                                    }

                                    document.getElementById('filter')
                                        .addEventListener('change', function(){
                                            buildUrl();
                                        });
                                </script>





                            </form>

                        </div>

                    </div>
                </div>





                    <table class="table table-striped">
                        <tbody>
                            @foreach($available as $item)
                                <tr>
                                    <td><a href="{{ url('/option/'.$item->id .'/home') }}">{{ $item->option_name }}</a></td>
                                    <td>{{ $item->option_description }}</td>


                                    <td>
                                        <form
                                                method="POSt"
                                                action="{{ url('index/forms/
quantity/') }}"
                                                class="form-inline">
                                            <input type="hidden" name="form_element_id" value="{{ $element->id }}">
                                            <input type="hidden" name="option_id" value="{{ $item->id }}">
                                            {{ csrf_field() }}
                                            <input aria-label=""
                                                   type="number"
                                                   name="position"
                                                   id="position"
                                                   size="4"
                                                   class="form-control"
                                                   value="{{ $count+1 }}"
                                                   min="0" step="1" max="{{ $count+1 }}">
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


    <br>
    @includeIf('index::index.forms.elements.shared.rules')


@endsection


