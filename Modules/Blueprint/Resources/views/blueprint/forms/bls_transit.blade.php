<div class="list-group">

{{--    @if( ! $configuration->contains('FTB-Z999-001') )--}}

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 5]) }}">

            <h4 class="text-primary">Chassis</h4>
            <p>Wheelbase, roof height, and style of vehicle. .</p>
        </a>

{{--    @else--}}
{{--        <a class="list-group-item list-group-item-success">--}}
{{--            <h4 class="text-success">Van Configured!--}}
{{--                <img src="{{ mix('img/checkmark.png') }}"--}}
{{--                     class="float-end"--}}
{{--                     width="30"--}}
{{--                     height="30"--}}
{{--                     alt=""></h4>--}}
{{--            <p></p>--}}
{{--        </a>--}}

{{--    @if( ! $configuration->contains('FTB-Z999-001') )--}}


        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 6]) }}">

            <h4 class="text-primary">Stretcher Position</h4>
            <p>Brand and model of stretcher mount.</p>
        </a>


        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 7]) }}">

            <h4 class="text-primary">Stretcher Positions</h4>
            <p>Brand and model of stretcher mounts for two-position configurations.</p>
        </a>

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 8]) }}">

            <h4 class="text-primary">Side-Entry Wheelchair Lift</h4>
            <p>Brand and model of wheelchair lift for side-entry applications.</p>
        </a>

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint, 9]) }}">

            <h4 class="text-primary">Rear-Entry Wheelchair Lift</h4>
            <p>Brand and model of wheelchair lift for vehicles needing wheelchair access from the rear..</p>
        </a>


    <a class="list-group-item list-group-item-action"
       href="{{ route('blueprint.wizard', [ $blueprint, 12]) }}">

        <h4 class="text-primary">Stretcher Mount (with wheelchair lift)</h4>
        <p>Brand and model of stretcher mounts for configurations with a wheelchair lift.</p>
    </a>


    <a class="list-group-item list-group-item-action"
       href="{{ route('blueprint.custom_layout', [ $blueprint, 'floor' ]) }}">

        <h4 class="text-primary">Floor Layout</h4>
        <p>Drag and drop the components you want added to this vehicle design.</p>
    </a>



    <a class="list-group-item list-group-item-action"
       href="{{ route('blueprint.custom_layout', [ $blueprint, "equipment_enclosure" ]) }}">

        <h4 class="text-primary">Equipment Enclosure Layout</h4>
        <p>Drag and drop the components you want added to the rear-driver-side wall.</p>
    </a>




{{--@endif--}}


<!---->
<!--    @if( $configuration->contains('DCM-Z100-001') )-->
<!---->
<!--        <a class="list-group-item lis-group-item-action"-->
<!--           href="{{ route('blueprint.form', [ $blueprint,  71 ]) }}">-->
<!---->
<!--            <h4 class="text-primary">Extras (Malley Only)</h4>-->
<!--            <p>Extra quote line items</p>-->
<!--        </a>-->
<!---->
<!--        @else-->
<!--            <a class="list-group-item  list-group-item-light" >-->
<!---->
<!--                <h4 class="">Extras (Malley Only)</h4>-->
<!--                <p>Finish the configuration wizard before using this form.</p>-->
<!--            </a>-->
<!--    @endif-->

</div>