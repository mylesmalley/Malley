<div class="row">
    <div class="col-8 offset-2">
        <div class="card border-primary  ">
{{--            <div class="card-header text-white bg-secondary">--}}
{{--                <h4 class="">{{ $element->label }}</h4>--}}
{{--            </div>--}}
            <div class="card-body">

                    <canvas style="border: 3px solid red;" id="{{ md5( $element->id ) }}"></canvas>
                    @push('scripts')

                    <script>

                            let stage = new Konva.Stage({
                                container: '{{ md5( $element->id ) }}',
                                width: {{ $width }} ,
                                height: {{ $height }},
                            });

                            @foreach( $media as $med )

                                let layer{{ substr(md5( $med->id), 0, 5 ) }} = new Konva.Layer();
                                stage.add(layer{{ substr(md5( $med->id), 0, 5 ) }});

                                {{--Konva.Image.fromURL("{!!  $med->cdnUrl() !!}", function(image){--}}
                                {{--    // image is Konva.Image instance--}}
                                {{--    img{{ md5( $med->id ) }}.add(image);--}}
                                {{--    img{{ md5( $med->id ) }}.draw();--}}
                                {{--});--}}


                            let img{{ substr(md5( $med->id), 0, 5 ) }} = new Image();
                            img{{ substr(md5( $med->id), 0, 5 ) }}.onload = function () {
                                let yoda = new Konva.Image({
                                    x: 0,
                                    y: 0,
                                    image: img{{ substr(md5( $med->id), 0, 5 ) }},
                                    // width: 106,
                                    // height: 118,
                                });

                                // add the shape to the layer
                                layer{{ substr(md5( $med->id), 0, 5 ) }}.add(yoda);
                            };
                            img{{ substr(md5( $med->id), 0, 5 ) }}.src = '{!!  $med->cdnUrl() !!}';








                            @endforeach

                    </script>
                    @endpush
{{--                @foreach( $media as $med )--}}
{{--                    <img src="{{ $med->cdnUrl() }}" alt="">--}}
{{--                    @endforeach--}}
            </div>
        </div>
    </div>
</div>
