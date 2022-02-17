<div class="row">
    checklist
{{--    {{ dd($element, $element->items, $items) }}--}}
    @foreach( $items as $item )
        {{ $configuration[ $item->option_id ]['description'] }} <br>
        @endforeach
</div>