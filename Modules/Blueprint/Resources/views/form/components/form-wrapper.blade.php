<div>
    form wrapper

       @foreach( $elements as $element )

{{--           @if ($element->type === 'images')--}}
{{--               @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,--}}
{{--                                                    'element' => $element,--}}
{{--                                                    'media' => $element->itemMedia()  ]  )--}}

{{--           @endif--}}
           @if ($element->type === 'checklist')
               @livewire("blueprint::form.checklist", [ $blueprint, $element  ]  )
           @endif
           @if ($element->type === 'selection')
               @livewire("blueprint::form.selection", [ $blueprint, $element  ]  )
           @endif
           <br>
       @endforeach
</div>