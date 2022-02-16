<div class="list-group">
    @foreach( $forms as $form )
        <a class="list-group-item list-group-item-action"
           href="{{ route('blueprint.form', [ $blueprint, $form->id]) }}">

            <h4 class="text-primary">{{ $form->name }}</h4>
            <p>Form Description</p>
        </a>
    @endforeach
</div>