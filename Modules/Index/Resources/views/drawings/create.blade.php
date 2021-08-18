@extends('index::app.main')

@section("content")


    <h1> Upload Drawing </h1>
    <h3>For {{ $option->option_name }}</h3>


        <form action="/index/option/{{ $option->id }}/drawings" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <br />
            <input type="file" name="drawing"  />
            <br />
            <input type="submit" value="Upload Image" />
        </form>



@endsection
