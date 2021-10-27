<div class="list-group">

    @if( ! $configuration->contains('TBL-Z999-001') )

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint->id, 5]) }}">

            <h4 class="text-primary">Chassis</h4>
            <p>Wheelbase, roof height, and style of vehicle. .</p>
        </a>

    @else
        <a class="list-group-item list-group-item-success">
            <h4 class="text-success">Van Configured!
                <img src="{{ mix('img/checkmark.png') }}"
                     class="float-end"
                     width="30"
                     height="30"
                     alt=""></h4>
            <p></p>
        </a>
    @endif


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