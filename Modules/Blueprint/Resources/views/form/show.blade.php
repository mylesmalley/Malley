@extends('blueprint::layouts.master')

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $form->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->name ?? 'Van' }}</h3>
        </div>
    </div>


   <div class="row">
       <div class="col-8 offset-2">
           <div class="card border-primary">
               <div class="card-header">

               </div>
               <div class="card-body">
                   @foreach( $form->elements as $element )


                       @if ($element->type === 'checklist')
                           @livewire("blueprint::form.checklist", [ $blueprint, $element  ]  )
                       @endif
                       @if ($element->type === 'selection')
                           @livewire("blueprint::form.selection", [ $blueprint, $element  ]  )
                       @endif
                   @endforeach
               </div>
           </div>
       </div>
   </div>

{{--    <div class="row">--}}
{{--        <div class="col-6 offset-3">--}}
{{--            @livewire("blueprint::question", ['blueprint'=>$blueprint, 'wizard'=>$wizard ]  )--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <br>--}}
{{--    <div class="row">--}}
{{--        <div class="col-10 offset-1">--}}
{{--            @livewire("blueprint::progress", ['blueprint'=>$blueprint,  'wizard'=>$wizard  ] )--}}
{{--        </div>--}}
{{--    </div>--}}

    <br><br>
@endsection