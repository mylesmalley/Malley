<div class="list-group">

    @if( ! $configuration->contains('RPM-Z999-001') )

        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.wizard', [ $blueprint->id, 4]) }}">

            <h4 class="text-primary">Configure Your ProMaster</h4>
            <p>This form will walk you through the design of your vehicle.</p>
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


</div>