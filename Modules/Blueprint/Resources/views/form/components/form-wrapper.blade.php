<div>
{{--        {{ dd( $configuration ) }}--}}
       @foreach( $elements as $el)
{{--           @if ($element->type === 'images')--}}
{{--               @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,--}}
{{--                                                    'element' => $element,--}}
{{--                                                    'media' => $element->itemMedia()  ]  )--}}
{{--            {{ dd( $el) }}--}}
{{--            {{ dd( $el->items ) }}--}}
{{--           @endif--}}

    @if ($el->type === 'checklist')
            @livewire("blueprint::form.checklist", [  $el, $configuration  ], key('element-'.$el->id)  )

        @endif
           @if ($el->type === 'selection')
               @livewire("blueprint::form.selection", [ $el, $configuration  ], key('element-'.$el->id)   )
           @endif
           <br>
       @endforeach
</div>