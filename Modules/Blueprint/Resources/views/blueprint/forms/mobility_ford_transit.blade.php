<div class="list-group">

    @if( ! $configuration->contains('FTM-Z900-001') )

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint->id, 1]) }}">

            <h4 class="text-primary">Configure Your Van</h4>
            <p>This form will walk you through the design of your vehicle, including the chassis, lift brand and other options.</p>
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







    @if( $configuration->contains('FTM-Z900-001') )

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.floor_layout', [ $blueprint ]) }}">

            <h4 class="text-primary">Floor Layout</h4>
            <p>Drag and drop the components you want added to this vehicle design.</p>
        </a>

        @else
            <a class="list-group-item  list-group-item-light" >

                <h4 class="">Floor Layout</h4>
                <p>Before you can design the floor layout, complete the
                        Configure Your Van form. </p>
            </a>
    @endif


        {{-- Medical Equipment form --- OPTIONAL --}}
        @if( $configuration->contains('FTM-Z901-001') )

            <a class="list-group-item list-group-item-action"
               href="{{ route('blueprint.form', [ $blueprint->id, 72]) }}">

                <h4 class="text-primary">Medical Equipment</h4>
                <p>Drag and drop the components you want added to this vehicle design.</p>
            </a>
        @endif




        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.form', [ $blueprint->id, 44]) }}">
{{--            href="{{ route('blueprint.form', [ $blueprint->id, 6]) }}">--}}

            <h4 class="text-primary">Malley-Only Options</h4>
            <p>Quote Lines &amp; Discounts </p>
        </a>
</div>