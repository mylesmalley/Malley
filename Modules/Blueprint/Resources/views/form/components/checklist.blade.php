<div class="row">
    checklist
{{--    {{ dd($element, $element->items, $items) }}--}}
    @foreach( $items as $item )
        {{ $item->id }} <br>
        @endforeach
</div>