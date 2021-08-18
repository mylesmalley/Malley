@extends('index::app.main')

@section('content')

    <div class="panel-heading"><h1>


                Clone {{ $option->option_name }}
        </h1>
    </div>

    @includeIf('app.components.errors')

    <div class="panel-body">


        <form
            method="POST"
            action="{{  url('/option/clone') }}">


            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $option->id }}" />
            User id
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            Option to clone from
            <input type="text" name="option_id" id="option_id" value="{{ $option->id }}">
    <br>
            old name
            <input type="text" name="old_name" id="old_name" value="{{ $option->option_name }}">
<br>
            new name
            <input type="text" name="option_name" id="option_name" value="{{ $option->option_name }}">
            <br>
            syspro phantom
            <input type="text" name="option_syspro_phantom" id="option_syspro_phantom" value="{{ $option->option_syspro_phantom }}">

            <br>
            new description
            <input type="text" name="option_description" id="option_description" value="{{ $option->option_description }}">

            <h3>About</h3>


            <h3>Reason for Retirement</h3>

                        <textarea required
                                  id="engineering_notes"
                                  name="engineering_notes"
                                  class="form-control"
                                  aria-label="">{{ old('engineering_notes') ?? "Cloned from {$option->option_name}" }}</textarea>


            <input type="submit" value="Clone This Option" class="btn btn-danger">

    </form>



    </div>
            @endsection

@section('javascript')

@endsection
