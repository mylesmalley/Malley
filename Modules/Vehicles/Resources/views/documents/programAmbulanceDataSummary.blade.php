<html>
<head>
{{--    <style>--}}
{{--        tr {--}}
{{--            padding-bottom: 5px;--}}
{{--            color:blue;--}}
{{--        }--}}
{{--    </style>--}}
</head>
<body>


<h1>Program Ambulance Data Summary</h1>

<table>
    <tr style="padding-bottom:10px;">
        <td>Name of Service:</td>
        <td>Medavie Health Services NB Inc. (NB-EMS)</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Chassis:</td>
        <td>{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} van chassis with Malley Industries NB Type II Ambulance Conversion</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Chassis Serial Number:</td>
        <td>{{ $vehicle->vin }}</td>
    </tr>

    <tr style="padding-bottom:10px;">
        <td>Production #:</td>
        <td>{{ $vehicle->malley_number  }}  (MHSNB CALL#{{ $vehicle->customer_number }})</td>
    </tr>

    <tr style="padding-bottom:10px;">
        <td>Invoice:</td>
        <td>{{ $vehicle->finance_invoice_number ?? 'MISSING INVOICE NUMBER' }}</td>
    </tr>

    <tr style="padding-bottom:10px;">
        <td>Total Invoice Value: </td>
        <td>

            @if ( $vehicle->finance_pretax_invoice_value && $vehicle->finance_invoice_total_tax )
            ${{ number_format( $vehicle->finance_pretax_invoice_value , 2) }} +

            ${{ number_format( $vehicle->finance_invoice_total_tax , 2) }} (HST) =
            ${{ number_format( $vehicle->finance_pretax_invoice_value + $vehicle->finance_invoice_total_tax , 2) }}
            @else
                MISSING INVOICE VALUES
            @endif
        </td>
    </tr>
</table>

<br>
<hr>
<br>


<table>
    <tr style="padding-bottom:10px;">
        <td>Lease No: </td>
        <td>{{ $vehicle->finance_lease_number ?? 'MISSING LEASE NUMBER' }}</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Lease Term:</td>
        <td>4 YEAR</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Start Date of Lease:</td>
        <td>{{  Carbon\Carbon::createFromDate( $vehicle->date_in_service )->format('d M Y') ?? 'MISSING IN SERVICE DATE' }}</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Lease Completion Date:</td>
        <td>{{ Carbon\Carbon::createFromDate( $vehicle->date_lease_expired )->format('d M Y') ?? "MISSING LEASE EXPIRED DATE" }}</td>
    </tr>
    <tr style="padding-bottom:10px;">
        <td>Total Monthly Lease Payment:</td>
        <td>

            @if ( $vehicle->finance_monthly_lease_pretax && $vehicle->finance_monthly_lease_tax )
                ${{ number_format( $vehicle->finance_monthly_lease_pretax , 2) }} +

                ${{ number_format( $vehicle->finance_monthly_lease_tax , 2) }} (HST) =
                ${{ number_format( $vehicle->finance_monthly_lease_pretax + $vehicle->finance_monthly_lease_tax , 2) }}
            @else
                MISSING INVOICE VALUES
            @endif
            <br>

            48 MONTH TERM</td>
    </tr>
</table>



<h1>*REPLACING {{ $vehicle->refurb_number ?? "MISSING REFURB NUMBER" }}</h1>

</body>
</html>
