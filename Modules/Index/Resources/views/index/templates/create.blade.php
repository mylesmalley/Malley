@extends('index::app.main')

@section('content')

    <div class="row text-center">
        <h1>
            {{ $basevan->name }}
        </h1>

        <h2 class="text-secondary">New Template</h2>
    </div>


    @includeIf('app.components.errors')


    <form action="{{ route('platform.templates.store', [$basevan]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $basevan->id }}"
               id="base_van"
               name="base_van">

        <div class="row">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-header bg-primary text-white">
                        Template
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Title</label>
                                <input type="text"
                                       id="name"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       name="name">
                            </div>
                            <div class="col-md-12">
                                <label for="template">Template</label>
                                <textarea name="template"
                                          class="form-control"
                                          id="template"
                                          cols="30" rows="10">{{ old('template') }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-md-3'>
                                <label for="order">Order</label>
                                <input type="number"
                                       id="order"
                                       class="form-control"
                                       value="{{ old('order', 1) }}"
                                       name="order">
                            </div>

                            <div class="col-md-2">
                                <label for="visibility">Visibility</label>
                                <select name="visibility" class="form-control" id="visibility">
                                    @foreach(['1'=>"Visible",'0'=>'Hidden'] as $k => $v)
                                        <option  {{ old('visibility') == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="sales_drawing">Sales Package Page</label>
                                <select name="sales_drawing"  class="form-control"  id="sales_drawing">

                                    @foreach(['1'=>"Yes",'0'=>'No'] as $k => $v)
                                        <option  {{ old('sales_drawing') == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="production_drawing">Production Package Page</label>
                                <select name="production_drawing"  class="form-control"  id="production_drawing">

                                    @foreach(['1'=>"Yes",'0'=>'No'] as $k => $v)
                                        <option  {{ old('production_drawing') == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="pdf">PDF</label>
                                <select name="pdf" class="form-control" id="visibility">
                                    @foreach([ '0'=>'No', '1'=>"Yes"] as $k => $v)
                                        <option  {{ old('pdf') == $k ? 'selected' : '' }} value="{{ $k }}">{{ $v }}</option>

                                    @endforeach
                                </select>
                            </div>

                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <input type="submit" class="btn btn-success" value="Save Changes">
                    </div>
                </div>
            </div>
        </div>
    </form>


    <br>



    <div class="row">
        <div class="col-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Instructions</div>
                <div class="card-body">
                    <p> Make sure you save this form before leaving the page.</p>
                    <p> Paste <b>@OPTIONS@</b> wherever you want the list of options placed. For Sales docs, we show an unordered html list. Production drawings show tables with parts.</p>
                    <p> To include an image, use this format: <b>&lt;img src="@URL@imagename.png" alt="Image Title" /&gt;</b></p>
                </div>
            </div>
        </div>



        <div class="col-6">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    Options That Appear Here
                </div>
                <div class="card-body">

                    Save this template and then edit it to add options.
                </div>
            </div>
        </div>

    </div>


    <br>

    <br>





{{--        <input type="submit" class="btn btn-primary">--}}
{{--    </form>--}}
{{--    <br />--}}
{{--    <br />--}}
{{--    <hr />--}}

{{--    <br />--}}

{{--    <div class="row">--}}

{{--        <div class='col-md-8'>--}}
{{--            <h3>Options on this Page--}}
{{--                <a href="{{ $template->url('options') }}" class=" btn btn-sm btn-primary">Edit Options</a>--}}
{{--            </h3>--}}
{{--            <ul>--}}
{{--                @foreach($template->options as $opt)--}}
{{--                    <li>{{ $opt->option_name }} - {{ $opt->option_description }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--        <div class="col-md-4">--}}
{{--            <h3>Available Images</h3>--}}
{{--            <ul>--}}
{{--                @foreach( $imageNames as $image )--}}
{{--                    <li>{{ $image }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <br /> <br />--}}

@endsection
