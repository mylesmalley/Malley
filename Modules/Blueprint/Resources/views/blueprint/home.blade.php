@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $blueprint->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->platform->name ?? 'Van' }}</h3>
        </div>
    </div>

     <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            About This Blueprint
        </div>

            <div class="row">
                <div class="col-4">
                    <table class="table">
                        <tr>
                            <th class="text-end">Ref#</th>
                            <td class="fw-bolder">B-{{ $blueprint->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Name</th>
                            <td>{{ $blueprint->name ?? "Name of Blueprint" }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Type</th>
                            <td>{{ $blueprint->platform->name ?? 'Type of Blueprint' }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Description</th>
                            <td>{{ $blueprint->description ?? 'Description' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-4">
                    <table class="table">
                        <tr>
                            <th class="text-end">Customer</th>
                            <td>{{ $blueprint->customer_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Address</th>
                            <td>
                                @if( $blueprint->customer_address_1 )
                                    {{ $blueprint->customer_address_1 }} <br>
                                @endif
                                @if( $blueprint->customer_address_2 )
                                    {{ $blueprint->customer_address_2 }} <br>
                                @endif
                                @if( $blueprint->customer_city || $blueprint->customer_province || $blueprint->customer_country )
                                    {{ $blueprint->customer_city ?? '' }}, {{ $blueprint->customer_province ?? '' }}, {{ $blueprint->customer_country ?? '' }} <br>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="col-4">
                    <table class="table">
                        <tr>
                            <th class="text-end">Created By</th>
                            <td>{{ $blueprint->user->first_name . ' ' . $blueprint->user->last_name }}</td>
                        </tr>
                        <tr>
                            <th class="text-end">Dealer</th>
                            <td>
                                {{ $blueprint->user->company->name }}
                                @if ( $blueprint->user->company->hasMedia('logo'))
                                    <br>
                                    <img alt="Logo"
                                         width="200"
                                         src="{{ $blueprint->user->company->getMedia('logo')->first()->cdnURL() }}"><br>
                                @endif
                            </td>

                        </tr>
                    </table>
                </div>

            </div>

    </div>




@endsection