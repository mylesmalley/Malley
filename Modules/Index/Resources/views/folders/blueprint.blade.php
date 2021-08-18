@extends('index::folders.template')
@section('stylesheet')
    <style>
        .folder-card {
            height:160px;
        }

    </style>
@endsection
@section('content')

    <div class="panel-heading">
        <div class="row">
            <div class="panel-heading text-center">
                <h2 class="display-3">{{ $folder->name ?? 'NAME??' }}</h2>
            </div>

            <h4 style="padding:15px;">
            @forelse( $folder->ancestors as $ancestor )
                @if ( ! $ancestor->isRoot() )
                <a href="{{ url('/folder/'.enc( $ancestor->id )) }}">{{ $ancestor->name ?? 'ancestor' }}</a>	&gt;
                @endif
            @empty
                <a href="/folders/">Uploads</a>	&gt;
            @endforelse
            </h4>
        </div>

            <hr >

        <div class="row">
            @foreach( $folder->children->sortBy('name') as $child )
                <div class="folder-card col-md-2 text-center">
                    <a href="{{ url('/folder/'.enc( $child->id )) }}">
                        <img width="75"
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAMAAABrrFhUAAAATlBMVEX///////////////////////////////////////////////////////////////////////////////////////////////////////+QPFRFAAAAGXRSTlMABgkqKyyOj5CUlZi7vdTW19jz9Pj5+vz9eAto8AAAAbhJREFUeNrt2GFugkAURtHBqgiqpa0UZv8b7QIwKUpMYN65O3jnz0y+lCRJkiRJkiRJkiRJkiRJUug+jt09P9n98/hRyPlVM+aXGs+7Iu6/5Je7VgUAtHlBzfbv3w9LAIb95gHqvKh68wDdMoBu8wD9MoA+zLu/9p74l7z87q+9mf+SJe/+2pv1L2lzwTXvfvfX3ox/SZ2Lrn73u7/2une/+2uvT5IkSVF2gCd2gWJ3gJm7QMk7wKxdoM2BaqLtADN2gTqHqo62A/y/C/SxAKa7QA4WAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAsCaAPtb93xOALhbAbQJQxwI4TQAOQ6T7h8MEILWRANrp/am6xLn/WqVHAs0Y4/zxvEuP25++fku//ud2OiRJkiRJkiRJkiRJkiRJkhSiP2hYv9JUwby3AAAAAElFTkSuQmCC"
                        alt="" ><br>
                        {{ $child->name }}</a>
                </div>


            @endforeach
                @foreach( $folder->media->sortBy('file_name') as $media )
                    <div class="folder-card col-md-2 text-center">
                        <a href="{{ $media->cdnUrl() }}">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEACAMAAABrrFhUAAAAkFBMVEX///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////9oY44IAAAAL3RSTlMAAwYHDBcjJDM6PVFSU1RVVltcdHaJipOUnJ2mq6y2wMHX2dvf4OPk8vP4+fr8/Q7ReRAAAAKVSURBVHhe7d3LctNgEERh6SeBcJOxQeGSKGBsx4CC+/3fDnlPMbvxMHPOI3zrrurur7V3d/tZF+/n9m7Vugv0eqcw7d64A/SjQjX2zgCjgjX6AgwK1+AJ0B4VrmNzBFgrYBtHgHsFbHIEOChgB0eAXwrY7AigkFUDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADA2A/kBzD2A1UBpLEvDqCxOoCG6gDHVhxAm+oAU3WAQ3WAuTqASgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGDvB7ID2PuB4gDS2BcH0FgdQEN1gGMrDqBNdYCpOsChOsBcHUD/PwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD8UMBmR4DvCthhAWhOAPcK2LQAXDsBrBWwzQLwygmgPSpcx2cLwAcngG6lcK26pa9eAN2tgnXbLb04uQH0HxWqT3239Nnznf7tTmHaDd25m9+eAF1bT/snXbyn/bRu3bmrrRwA4tYeVBrg6kGlAW62qgzw/MtJVQHa9cv3305SKAC55wAAAAAAAAAAAAAAAAAAAAAAAAAAAJBwP2CUfz9glH8/YJR/P2CUfz9glH8/YJR/P2CUfz9glH8/YJR/P2CUfz9glH8/YJR/P2CUfz9glH8/4JdiBAAAAAAAAAAAAAAAAAAAAAAAAABglH8/YJR/P2CUfz9glH8/YJR/P2CUfj9glX0/YJZ9P2CWfD9gl3o/8O/+AJFt/rB3dIjpAAAAAElFTkSuQmCC"
                            alt=""
                                 width="75"
                            ><br />

                            {{ $media->name }}</a>
                    </div>
                    @endforeach
        </div>

    </div>

@endsection
