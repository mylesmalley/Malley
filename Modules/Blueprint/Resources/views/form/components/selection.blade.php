<div class="row">
    selection
{{--    {{ dd( $element ) }}--}}
    @foreach( $items as $item )
        {{ $configuration[ $item->option_id ]['description'] }} <br>
    @endforeach
</div>