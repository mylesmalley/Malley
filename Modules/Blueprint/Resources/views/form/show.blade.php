@extends('blueprint::layouts.master')

@push('scripts')
    <script src="{{ mix('js/blueprint/floor_layout.js') }}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h1> {{ $form->name }} </h1>
            <h3 class="text-secondary">{{ $blueprint->name ?? 'Van' }}</h3>
        </div>
    </div>



   @foreach( $form->elements as $element )

       @if ($element->type === 'images')
           @livewire("blueprint::form.image", [ $blueprint, $element  ]  )
       @endif
       @if ($element->type === 'checklist')
           @livewire("blueprint::form.checklist", [ $blueprint, $element  ]  )
       @endif
       @if ($element->type === 'selection')
           @livewire("blueprint::form.selection", [ $blueprint, $element  ]  )
       @endif
       <br>
   @endforeach

    <div class="text-center">
        <br>
        <a href="{{ route('blueprint.home', [$blueprint])  }}" class="btn btn-success">Back to Blueprint</a>
        <span>Your changes have been saved automatically.</span>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


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