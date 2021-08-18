@extends('index::app.main')

@php
    $redirect = (request()->headers->get('referer'))
                ? str_replace( "https://".request()->headers->get('host'), '',  request()->headers->get('referer') )
                : "/basevan";
@endphp


@section("content")

    <h1>Option Index Preferences</h1>

    @if (session('message'))
        <div class="row alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="post" action="{{ url('index/preferences') }}">
        {{ csrf_field() }}
        {{ method_field("PATCH") }}
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <input type="hidden" name="referer" value="{{ $redirect }}">

        <br>

        <h3>Options You See</h3>

        <div class="row">
            <div class="col-md-3">
                <label for="index_show_obsolete_options">Show Obsolete Options</label>
                <select name="index_show_obsolete_options"
                        id="index_show_obsolete_options"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                            @if ( $user->index_show_obsolete_options == $key ||  old('index_show_obsolete_options')
                                && old('index_show_obsolete_options') === $key)
                            selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3">
                <label for="index_show_blueprint_only_options">Show Blueprint-Only Options</label>
                <select name="index_show_blueprint_only_options"
                        id="index_show_blueprint_only_options"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_blueprint_only_options == $key ||  old('index_show_blueprint_only_options')
                                    && old('index_show_blueprint_only_options') === $key)
                                selected
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    <br>


            <h3>Columns You See</h3>

        <div class="row">

            <div class="col-md-3">
                <label for="index_show_id_column">ID Number</label>
                <select name="index_show_id_column"
                        id="index_show_id_column"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_id_column == $key ||  old('index_show_id_column')
                                    && old('index_show_id_column') === $key)
                                selected
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="index_show_phantom_column">Syspro Phantom</label>
                <select name="index_show_phantom_column"
                        id="index_show_phantom_column"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_phantom_column == $key ||  old('index_show_phantom_column')
                                    && old('index_show_phantom_column') === $key)
                                selected
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>



            <div class="col-md-3">
                <label for="index_show_tags_column">Option Tags</label>
                <select name="index_show_tags_column"
                        id="index_show_tags_column"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_tags_column == $key ||  old('index_show_tags_column')
                                    && old('index_show_tags_column') === $key)
                                selected
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="index_show_errors_column">Option Errors</label>
                <select name="index_show_errors_column"
                        id="index_show_errors_column"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_errors_column == $key ||  old('index_show_errors_column')
                                    && old('index_show_errors_column') === $key)
                                selected
                                @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>




            <div class="col-md-3">
                <label for="index_show_pricing_columns">Show Pricing</label>
                <select name="index_show_pricing_columns"
                        id="index_show_pricing_columns"
                        class="form-control">
                    @foreach([ 0 => "No", 1 => "Yes"] as $key => $value)
                        <option value="{{ $key }}"
                                @if ( $user->index_show_pricing_columns == $key ||  old('index_show_pricing_columns')
                                    && old('index_show_pricing_columns') === $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>




        </div>


        <br /> <br />
        <div class="row">
            <div class="col-md-5">
                <input type="submit" value="Save Preferences" class="btn btn-primary btn-lg">
            </div>
        </div>

    </form>

@endsection
