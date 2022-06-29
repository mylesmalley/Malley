@extends('bodyguardbom::layouts.master')

@section('content')


    <div class="row">
        <div class="col-2">
        </div>
        <div class="col-8 text-center">
            <h1>Bodyguard Part Index</h1>
            <h3 class="text-secondary ">
                <br>
            </h3>

        </div>
        <div class="col-2">

        </div>
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-12 text-center">--}}
{{--            <a class="btn btn-primary"--}}
{{--               href="{{ route('bg.kits.home') }}">Bodyguard Kits Index</a>--}}
{{--            <a class="btn btn-secondary"--}}
{{--               href="{{ route('bg.parts.home') }}">Bodyguard Parts Index</a>--}}
{{--        </div>--}}
{{--    </div>--}}


    @includeIf('app.components.errors')


    <div class="card border-secondary">

        <div class="card-header bg-secondary   ">
            <ul class="nav nav-tabs card-header-tabs ">
                <li class="nav-item">
                    <a class="nav-link text-white"
                       href="{{ route('bg.kits.home') }}">Kit Index</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active"
                       href="{{ route('bg.parts.home') }}">Components Index</a>
                </li>
            </ul>
        </div>


        <div class="card-body ">
            <form class="row row-cols-lg-auto g-3 align-items-end"
                  action="{{ route('bg.parts.home') }}"
                  method="GET">

                @csrf

                <div class="col-2">
                    <label for="chassis"
                           class="form-label">
                        Chassis & Wheelbase</label>
                    <select class="form-control"
                            name="chassis"
                            id="chassis">
                        <option value="ALL">All</option>
                        @foreach( $chassis as $van => $options )
                            <optgroup label="{{ $van }}">
                                @foreach( $options as $key => $desc)
                                    <option
                                            {{ request()->input('chassis') === $key ? " selected " : ""   }}
                                            value="{{ $key }}">{{ $desc  }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>


                <div class="col-1">
                    <label for="roof_height"
                           class="form-label">
                        Roof Height</label>
                    <select class="form-control"
                            name="roof_height"
                            id="roof_height">
                        <option value="ALL">All</option>
                        @foreach( $roof_heights as $key => $desc)
                            <option
                                    {{ request()->input('roof_height') === $key ? " selected " : ""   }}
                                    value="{{ $key }}">{{ $desc  }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-2">
                    <label for="kit_code"
                           class="form-label">
                        Part Type</label>
                    <select class="form-control"
                            name="kit_code"
                            id="kit_code">
                        <option value="ALL">All</option>
                        @foreach( $kit_codes as $key => $val)
                            <option
                                    {{ request()->input('kit_code') === $key ? " selected " : ""   }}
                                    value="{{ $key }}">{{ $val['desc']  }}</option>
                        @endforeach
                    </select>
                </div>





                <div class="col-2">
                    <label for="colour"
                           class="form-label">
                        Colour</label>
                    <select class="form-control"
                            name="colour"
                            id="colour">
                        <option value="ALL">All</option>
                        @foreach( $colours as $key => $desc)
                            <option
                                    {{ request()->input('colour') === $key ? " selected " : ""   }}
                                    value="{{ $key }}">{{ $desc  }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <label for="location"
                           class="form-label">
                        Location</label>
                    <select class="form-control"
                            name="location"
                            id="location">
                        <option value="ALL">All</option>
                            @foreach( $locations as $van => $options )
                                <optgroup label="{{ $van }}">
                                    @foreach( $options as $key => $desc)
                                        <option
                                                {{ request()->input('location') === $key ? " selected " : ""   }}
                                                value="{{ $key }}">{{ $desc  }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                    </select>
                </div>



                <div class="col-1 " >
                    <button
                            id="go"
                            name="go"
                            type="submit"
                            class="btn btn-success">Filter</button>
                </div>
                <div class="col-1 " >
                    <a href="{{ route('bg.parts.create') }}"
                       id="create_button"
                       class="btn btn-info">Add</a>
                </div>
            </form>




        </div>
    </div>






    <div class="row">
        <div class="col-12">
            <div class="card border-secondary">


                <table class="table table-hover table-striped">
                    <tbody>
                    @forelse( $results as $result )
                        <tr onclick="location.href = '{{ route('bg.kits.show', $result->id) }}'">
{{--                            <td>{{ $result->id }}</td>--}}
                            <td>{{ $result->part_number }}</td>
                            <td>{{ $result->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="1000">No records matching</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection

@push('scripts')
    <script>
        function updateUrl()
        {
            let query = new URLSearchParams();
            query.append('chassis', document.getElementById('chassis').value );
            query.append('colour', document.getElementById('colour').value );
            query.append('kit_code', document.getElementById('kit_code').value );
            query.append('roof_height', document.getElementById('roof_height').value );
            query.append('location', document.getElementById('location').value );
            document.getElementById('create_button').href = `{{ route('bg.parts.create') }}?${query}`;
        }

        updateUrl();

        document.getElementById('chassis').addEventListener('change', updateUrl);
        document.getElementById('colour').addEventListener('change', updateUrl);
        document.getElementById('kit_code').addEventListener('change', updateUrl);
        document.getElementById('roof_height').addEventListener('change', updateUrl);
        document.getElementById('location').addEventListener('change', updateUrl);
    </script>
@endpush