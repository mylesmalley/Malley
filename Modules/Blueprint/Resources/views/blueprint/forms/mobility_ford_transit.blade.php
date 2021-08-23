<div class="list-group">
    <a class="list-group-item list-group-item-action"
       href="{{ route('blueprint.wizard', [ $blueprint->id, 1]) }}">

        <h4 class="text-primary">Configure Your Van</h4>
        <p>This form will walk you through the design of your vehicle, including the chassis, lift brand and other options.</p>
    </a>

    <a class="list-group-item list-group-item-action"
       href="{{ route('my_blueprints') }}">

        <h4 class="text-primary">Floor Layout</h4>
        <p>Drag and drop the components you want added to this vehicle design.</p>
    </a>


</div>