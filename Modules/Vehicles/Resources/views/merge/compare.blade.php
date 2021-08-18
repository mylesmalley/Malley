@extends('vehicles::layout')
@section('content')
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-3">Compare or Merge Two Vehicles</h1>
        </div>
    </div>


    <table class="table">
        <tr>
            <td></td>
            <td><h1>A

{{--                        <input type="text"--}}
{{--                               name="a"--}}
{{--                               id="a"--}}
{{--                               value="{{ $a->id }}"--}}
{{--                               class="form-control">--}}

{{--                        <script>--}}
{{--                            document.getElementById('a', addEventListener('change', function(){--}}
{{--                               let temp =  document.getElementById('a').value;--}}
{{--                               location.href =`/vehicles/compare/${temp}/{{ $b->id }}`;--}}
{{--                      //          alert( `/vehicles/compare/${temp}/{{ $b->id }}` );--}}
{{--                            }));--}}
{{--                        </script>--}}






                </h1></td>
            <td><h1>B</h1>






            </td>
        </tr>
        <tr>
            <td>
                ID#
            </td>
            <td>
                {{ $a->id }}
            </td>
            <td>

                <input type="text"
                       name="b"
                       id="b"
                       value="{{ $b->id }}"
                       class="form-control">

                <script>
                    document.getElementById('b', addEventListener('change', function(){
                        location.href =`/vehicles/compare/{{ $a->id }}/${document.getElementById('b').value}`;
                    }));
                </script>

            </td>
        </tr>
        <tr>
            <td>
                Work Order
            </td>
            <td>
                {{ $a->work_order }}
            </td>
            <td>
                {{ $b->work_order }}
            </td>
        </tr>
        <tr>
            <td>VIN</td>
            <td>
                {{ $a->vin }}
            </td>
            <td>
                {{ $b->vin }}
            </td>
        </tr>
        <tr>
            <td>Malley Number</td>
            <td>
                {{ $a->malley_number }}
            </td>
            <td>
                {{ $b->malley_number }}
            </td>
        </tr>
        <tr>
            <td>Customer</td>
            <td>
                {{ $a->customer_name }}
            </td>
            <td>
                {{ $b->customer_name }}
            </td>
        </tr>
    </table>




    @if ( count($a->media ) || count($b->media )  )

    <br> <br>


    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-5">Uploaded Files</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
                <h2>Files
                    <a href="{{ url('vehicles/'.$a->id.'/files' ) }}"
                       class='btn btn-primary float-right'>Edit A's Files</a>
                </h2>

                <table class="table table-striped">

                    <tbody>
                    @forelse( $a->media as $media )
                        <tr>
                            <td>
                                <a href="{{ $media->cdnUrl() }}" download>
                                    {{ $media->file_name }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1">No Files</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

        </div>

        <div class="col-md-2 ">
            <a href="{{ url('/vehicles/moveFiles/'.$b->id.'/'.$a->id) }}"
                class="btn btn-lg btn-primary">
                &lt; &lt; Move Files &lt; &lt;
            </a>
            <br>
            <br>
            <a href="{{ url('/vehicles/moveFiles/'.$a->id.'/'.$b->id) }}"
               class="btn btn-lg btn-primary">
            &gt; &gt; Move Files &gt; &gt;
            </a>
        </div>

        <div class="col-md-5">
            <h2>Files
                <a href="{{ url('vehicles/'.$b->id.'/files' ) }}"
                   class='btn btn-primary float-right'>Edit B's Files</a>
            </h2>

            <table class="table table-striped">

                <tbody>
                @forelse( $b->media as $media )
                    <tr>
                        <td>
                            <a href="{{ $media->cdnUrl() }}" download>
                                {{ $media->file_name }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="1">No Files</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

    </div>



    @endif





    @if ( count($a->albums) || count($b->albums))
    <br><br><br>
    <!--

            PHOTO ALBUMS


    -->
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-5">Photo Albums</h1>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-5'>
            <h1 class="display-5">A's Albums</h1>

        <ul>
            @forelse( $a->albums as $album )
                <li>
                    @if( count( $album->ancestors) )

                        @foreach( $album->ancestors as $ancestor )
                            <a href="/albums/{{ $ancestor->id }}">{{ $ancestor->name }}</a>	&gt;
                        @endforeach
                        {{ $album->name }}
                    @endif
                    <form method="POST" action="{{ url('/vehicles/'.$a->id.'/albums/'.$album->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                        <input type="submit" class="btn btn-sm btn-warning" value="Unlink">
                    </form>
                </li>
            @empty
                <li>No Albums</li>
            @endforelse

        </ul>
    </div>



        <div class="col-md-2 ">
            <a href="{{ url('/vehicles/moveAlbums/'.$b->id.'/'.$a->id) }}"
               class="btn btn-lg btn-primary">
                &lt; &lt; Move Albums &lt; &lt;
            </a>
            <br>
            <br>
            <a href="{{ url('/vehicles/moveAlbums/'.$a->id.'/'.$b->id) }}"
               class="btn btn-lg btn-primary">
                &gt; &gt; Move Albums &gt; &gt;
            </a>
        </div>


    <div class='col-md-5'>
        <h1 class="display-5">B's Albums</h1>

        <ul>
            @forelse( $b->albums as $album )
                <li>
                    @if( count( $album->ancestors) )

                        @foreach( $album->ancestors as $ancestor )
                            <a href="/albums/{{ $ancestor->id }}">{{ $ancestor->name }}</a>	&gt;
                        @endforeach
                        {{ $album->name }}
                    @endif
                    <form method="POST" action="{{ url('/vehicles/'.$b->id.'/albums/'.$album->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                        <input type="submit" class="btn btn-sm btn-warning" value="Unlink">
                    </form>
                </li>
            @empty
                <li>No Albums</li>
            @endforelse

        </ul>
    </div>

    </div>

    @endif







    @if ( count($a->dates ) || count($b->dates )  )


        <br><br><br>
    <!--

            PHOTO ALBUMS


    -->
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-5">Dates</h1>
        </div>
    </div>


    <div class='row'>
        <div class='col-md-5'>
            <h1 class="display-5">A's Dates</h1>

            <table class="table table-striped">
                @foreach ( $a->dates  as $date )
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::create( $date->start)->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ urldecode( $date->title ) }}
                        </td>
                    </tr>
                @endforeach

            </table>


        </div>



        <div class="col-md-2 ">
            <a href="{{ url('/vehicles/moveDates/'.$b->id.'/'.$a->id) }}"
               class="btn btn-lg btn-primary">
                &lt; &lt; Move Dates &lt; &lt;
            </a>
            <br>
            <br>
            <a href="{{ url('/vehicles/moveDates/'.$a->id.'/'.$b->id) }}"
               class="btn btn-lg btn-primary">
                &gt; &gt; Move Dates &gt; &gt;
            </a>
        </div>


        <div class='col-md-5'>
            <h1 class="display-5">B's Dates</h1>

            <table class="table table-striped">
                @foreach ( $b->dates  as $date )
                    <tr>
                        <td>
                            {{ \Carbon\Carbon::create( $date->start)->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ urldecode( $date->title ) }}
                        </td>
                    </tr>
                @endforeach

            </table>


        </div>

    </div>


@endif







    <br><br><br>
    <!--

            FIELDS


    -->
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1 class="display-5">Fields</h1>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>A Value</th>
                    <th></th>
                    <th>B Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $a->availableFields() as $field )

{{--                    @if ( $a->$field !== null && $a->$field !== $b->$field  )--}}
                        @if( $a->$field || $b->$field )
                            <tr>
                                <td>
                                    {{ ucwords( str_replace('_', ' ', $field  ) ) }}

                                </td>
                                <td> {{ $a->$field }}


                                </td>
                                <td>


                                    <a href="{{ url('/vehicles/moveField/'.$a->id.'/'.$b->id.'/'.$field) }}"
                                       class="btn btn-sm btn-secondary">
                                        &gt; &gt; Copy to Right &gt; &gt;
                                    </a>

                                    <a href="{{ url('/vehicles/moveField/'.$b->id.'/'.$a->id.'/'.$field )  }}"
                                       class="btn btn-sm btn-primary">
                                        &lt; &lt; Copy to Left &lt; &lt;
                                    </a>




                                </td>
                                <td> {{ $b->$field }} </td>
                            </tr>
                        @endif
{{--                    @endif--}}
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="row">
        <div class="col-md-6">
                <a href="{{ url('/vehicles/markForDeletion/'.$a->id )  }}"
                   class="btn btn-lg btn-danger">
                        A CAN BE DELETED
                </a>
        </div>
        <div class="col-md-6">
            <a href="{{ url('/vehicles/markForDeletion/'.$b->id )  }}"
               class="btn btn-lg btn-danger">
                B CAN BE DELETED
            </a>
        </div>
    </div>


@endsection
