<div class="row" wire:init="draw">
    <div class="col-8 offset-2">
        <div class="card border-primary  ">
{{--            <div class="card-header text-white bg-secondary">--}}
{{--                <h4 class="">{{ $element->label }}</h4>--}}
{{--            </div>--}}
            <div class="card-body bg-secondary">

                    <div id="stage{{  $element->id  }}"></div>
                    @push('scripts')

                    <script>

                        Livewire.on('ready-to-draw', function() {

                            let stage = new Konva.Stage({
                                container: 'stage{{  $element->id  }}',
                                width: {{ $width }},
                                height: {{ $height }},
                            });


                            @foreach( $media as $med )

                                let layer{{ substr(md5( $med->id), 0, 5 ) }} = new Konva.Layer();
                                stage.add(layer{{ substr(md5( $med->id), 0, 5 ) }});


                            let img{{ substr(md5( $med->id), 0, 5 ) }} = new Image();
                            img{{ substr(md5( $med->id), 0, 5 ) }}.onload = function () {
                                let yoda = new Konva.Image({
                                    x: 0,
                                    y: 0,
                                    image: img{{ substr(md5( $med->id), 0, 5 ) }},
                                    width: {{ $width }},
                                    height: {{ $height }},
                                });

                                // add the shape to the layer
                                layer{{ substr(md5( $med->id), 0, 5 ) }}.add(yoda);

                            };
                            img{{ substr(md5( $med->id), 0, 5 ) }}.src = '{!!  $med->cdnUrl() !!}';



                            layer{{ substr(md5( $med->id), 0, 5 ) }}.draw();




                            @endforeach

                        });
                    </script>
                    @endpush

            </div>
        </div>
    </div>
</div>
