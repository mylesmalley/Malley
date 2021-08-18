@extends('vehicles::documents.pdi.template')

@section('content')


    <h1 style="text-align: center;">Inspection Form</h1>
    @includeIf('vehicles::documents.pdi.vehicle')

<table>
    <thead>
        <tr>
            <th>INITIAL INSPECTION</th>
            <th>FINAL INSPECTION</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>
                <table>

                    <tr>
                        <td style="text-align: right;">
                            Number of keys (and tagged)
                        </td>
                        <td style="text-align: right;">
                            ____
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Loose: mats, license plate brackets (2), antenna, manual
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Inspect body and paint for damage and finish
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Wheel centre cap
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Hood latch
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Battery - document voltage __________________
                        </td>
                        <td style="text-align: right;">
                            <h2>V</h2>
                        </td>
                    </tr>



                    <tr>
                        <td style="text-align: right;">
                            All fluid levels
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Fluid leaks
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Alternator rating __________________
                        </td>
                        <td style="text-align: right;">
                            <h2>A</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Place vehicle into customer mode
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Engine starts with all keys
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Engine starts in Park and Neutral only
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Visually inspect interior (inc. roof) for damage, fit, etc.
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            All interior lamps and horn
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Rear view mirror
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Front wipers and washers
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            Rear wipers and washers
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                           All interior door locks
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                           Power windows
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Power mirrors
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Seats and seat belts all adjustable
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Headlamps and fog lamps
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Signals
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Hazards
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                           Park
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            Tail and license plate
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Lock and unlock all doors with all keys
                        </td>
                        <td style="text-align: right;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Doors
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>





                    <tr>
                        <td style="text-align: right;">
                            Photo of VIN Plate
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>






                </table>

            </td>



            <td>
                <table>
                    <tr>
                        <td style="text-align: right;">
                            License plate brackets
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            All fluid levels
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            Fluid leaks
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Battery - document voltage _________
                        </td>
                        <td style="text-align: right;">
                            <h2>V</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center;" colspan="2">
                            Road Test
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Dealer or permanent plate installed
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Fuel level at least 1/4
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Dash warning lights
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Tire pressure monitoring system
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Service and parking brake
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                           Engine performance - COLD
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Automatic transmission shifting
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Steering and handling
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Cruise control
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                           Engine performance - WARM
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Noise, vibration, squeaks, rattles
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            PA system tested
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Anti-theft device
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Dealer or permanent plate installed
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">
                            APC Module (electronic auto throttle)
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td colspan="1" style="text-align: center">Final</td>
                    </tr>

                    <tr>
                        <td style="text-align: right;">
                            Inspect paint and body - touch up as needed
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Wash and clean exterior
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align: right;">
                            Wash and clean interior
                        </td>
                        <td style="text-align: right; font-weight: bolder;">
                            &#9744;
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: left;padding:6px; font-weight:  bolder; background-color: lightgray;" colspan="2">
                            NCV CLEARED BY
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </tbody>

</table>
    <table>
        <tr>
            <td><br>Inspected By: _________________________________</td>
            <td><br>Date: _________________</td>
        </tr>
    </table>

@endsection
