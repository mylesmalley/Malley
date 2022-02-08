@extends('vehicles::layout')

@section('content')



            <h1 class="text-center">
                Create Documents for <a href="{{ url('vehicles/'.$vehicle->id) }}">{{ $vehicle->identifier }}</a>
            </h1>

        <div class="card border-primary document-content-wrapper">

        <table class="table table-striped">
            @if( Auth::user()->vbd_modify_finance )
            <tr>
                <td>
                    <h3>Program Ambulance Data Summary</h3>
                    <p>Takes you to a form to fill out financial details about this vehicle's lease and then options for displaying.</p>
                </td>
                <td>
                    <a class='btn btn-secondary float-right'
                        href="{{ url('/vehicles/'.$vehicle->id.'/documents/ProgramAmbulanceDataSummaryForm') }}">Go</a>
                </td>
            </tr>
                @endif

                <tr>
                    <td>
                        <h3>PDI / Inspection Form</h3>
                        <p>Checklist for vehicles upon arrival and during road test.</p>
                    </td>
                    <td>
                        <a href="{{ url('vehicles/'.$vehicle->id.'/documents/pdiTransit' ) }}"
                           class='btn btn-secondary float-right'>Transit </a>
                        <a href="{{ url('vehicles/'.$vehicle->id.'/documents/pdiPromaster' ) }}"
                           class='btn btn-info float-right'>ProMaster </a>
                    </td>
                </tr>

                @if( Auth::user()->vdb_modify_inspections )

                    <tr>
                        <td>
                            <h3>Regulatory Stickers</h3>
                            <p>A form that lets you fill out details and test results and then generate stickers for FMVSS, CMVSS, National Safety Mark etc.</p>
                        </td>
                        <td>
                            <a href="{{ route('vehicle.regulatory.edit', [$vehicle]) }}" class='btn btn-secondary float-right'>Go</a>
                        </td>
                    </tr>

                @endif







                <tr>
                    <td>
                        <h3>Warranty Registration Instruction Card (Bilingual)</h3>
                        <p>Card with a QR code that customers can scan to get a warranty registration page. English and French text.</p>
                    </td>
                    <td>
                        <a href="{{ url('vehicles/'.$vehicle->id.'/warrantyCard' ) }}"
                           class='btn btn-secondary float-right'>GO </a>
                    </td>
                </tr>

                <tr>
                    <td>
                        <h3>Warranty Registration Instruction Card (English)</h3>
                        <p>Card with a QR code that customers can scan to get a warranty registration page. English only.</p>
                    </td>
                    <td>
                        <a href="{{ url('vehicles/'.$vehicle->id.'/warrantyCard/0' ) }}"
                           class='btn btn-secondary float-right'>GO </a>
                    </td>
                </tr>

                 &nbsp;

        </table>

        </div>


    @endsection


