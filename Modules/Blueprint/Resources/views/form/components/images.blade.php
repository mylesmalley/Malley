<div class="row" >
    <div class="col-10 offset-1">
        <div class="card border-primary  ">
{{--            <div class="card-header text-white bg-secondary">--}}
{{--                <h4 class="">{{ $element->label }}</h4>--}}
{{--            </div>--}}
            <div class="card-body bg-secondary">

                    <div id="stage{{  $element->id  }}"></div>


                    @push('scripts')

                    <script>


                            let stage = new Konva.Stage({
                                container: 'stage{{  $element->id  }}',
                                width: {{ getimagesize( $media->first()->cdnUrl() )[0] ?? 900 }},
                                height: {{ getimagesize( $media->first()->cdnUrl() )[1] ?? 500 }},
                            });

                            let layer = new Konva.Layer();
                            stage.add(layer);


                            @foreach( $media as $med )




                            let img{{ substr(md5( $med->id), 0, 5 ) }} = new Image();
                            img{{ substr(md5( $med->id), 0, 5 ) }}.onload = function () {
                                let yoda = new Konva.Image({
                                    x: 0,
                                    y: 0,
                                    image: img{{ substr(md5( $med->id), 0, 5 ) }},

                                });

                                // add the shape to the layer
                                layer.add(yoda);

                            };
                            img{{ substr(md5( $med->id), 0, 5 ) }}.src = '{!!  $med->cdnUrl() !!}';







                            @endforeach
                            layer.draw();

                    </script>
                    @endpush

            </div>
        </div>
    </div>
</div>
