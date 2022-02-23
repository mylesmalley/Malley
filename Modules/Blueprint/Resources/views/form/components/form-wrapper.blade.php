<div>
{{--        {{ dd( $configuration ) }}--}}
       @foreach( $elements as $el)
           @php
                $element_options = $el->items->pluck('option_id')->toArray();
           @endphp
{{--           @if ($element->type === 'images')--}}
{{--               @include("blueprint::form.components.images", [ 'blueprint' => $blueprint,--}}
{{--                                                    'element' => $element,--}}
{{--                                                    'media' => $element->itemMedia()  ]  )--}}
{{--            {{ dd( $el) }}--}}
{{--            {{ dd( $el->items ) }}--}}
{{--           @endif--}}

    @if ($el->type === 'checklist')
            @livewire("blueprint::form.checklist", [  $el,array_intersect_key( $configuration, array_flip( $element_options ))  ], key('element-'.$el->id)  )

{{--            @livewire("blueprint::form.checklist", [  $el,  $configuration  ], key('element-'.$el->id)  )--}}


        @endif
           @if ($el->type === 'selection')
{{--               {{ dd($configuration, $element_options) }}--}}
            @livewire("blueprint::form.selection", [ $el,  array_intersect_key( $configuration, array_flip( $element_options ))  ], key('element-'.$el->id)   )

{{--            @livewire("blueprint::form.selection", [  $el,  $configuration   ], key('element-'.$el->id)  )--}}
           @endif
           <br>
       @endforeach
</div>