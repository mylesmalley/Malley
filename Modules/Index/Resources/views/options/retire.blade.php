@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>


                Retire {{ $option->option_name }}
        </h1>
    </div>

    @includeIf('app.components.errors')

    <div class="panel-body">


        <form
            method="POST"
            action="{{  url('/index/option/retire') }}">


            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $option->id }}" />
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="option_id" id="option_id" value="{{ $option->id }}">


            <h3>About</h3>


            <h3>Reason for Retirement</h3>

                        <textarea required
                                  id="engineering_notes"
                                  name="engineering_notes"
                                  class="form-control"
                                  aria-label="">{{ old('engineering_notes') }}</textarea>



{{--            <p>Creating a new revision will:            </p>--}}

{{--            <ul>--}}
{{--                    <li>Mark the old revision obsolete</li>--}}
{{--                    <li>Attempt to pull components from Syspro if a valid phantom was provided</li>--}}
{{--                    <li>Copy rules and update references to match the current revision.</li>--}}
{{--                    <li>Duplicate photos and drawings and update.</li>--}}
{{--                    <li>Update forms to reference the new revision.</li>--}}
{{--                    <li>Update drawing packages to the new revision.</li>--}}
{{--                    <li>Update all Blueparints that aren't locked to have the new revision.</li>--}}
{{--                    <li>Turn off the old rev and turn on the new rev where appropriate on Blueprint.</li>--}}
{{--            </ul>--}}
            <input type="submit" value="Retire This Option" class="btn btn-danger">

    </form>



    </div>
            @endsection

@section('javascript')

@endsection
