<div>
    form wrapper

       @foreach( $elements as $el)
{{--           @if ($element->type === 'images')--}}
{{--               @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,--}}
{{--                                                    'element' => $element,--}}
{{--                                                    'media' => $element->itemMedia()  ]  )--}}
{{--            {{ dd( $el) }}--}}
{{--            {{ dd( $el->items ) }}--}}
{{--           @endif--}}

    @if ($el->type === 'checklist')
            @livewire("blueprint::form.checklist", [  $el  ], 'element-'.$el->id  )

        @endif
{{--           @if ($el->type === 'selection')--}}
{{--               @livewire("blueprint::form.selection", [ $el  ]  )--}}
{{--           @endif--}}
           <br>
       @endforeach
</div>