@php
    $tabs = [
        'options' => "/index/basevan/{$basevan->id}",
        'forms' => "/index/basevan/{$basevan->id}/forms",
        'layouts' => "/index/basevan/{$basevan->id}/layouts",
        'templates' => "/index/basevan/{$basevan->id}/templates",
        'wizards' => route('platform.wizards', [$basevan] ),
    ];

    if ( Auth::user()->can('option.set_pricing') )
    {
        $tabs['pricing'] ='pricing';
    }


    $target = $selected ?? "options";
@endphp
<div class="card-header bg-primary   ">
    <ul class="nav nav-tabs card-header-tabs ">
        @foreach( $tabs as $ref => $tab)
            <li class="nav-item">
                <a class="nav-link {{ $ref == $target ? 'active' : 'text-white' }}"
                   href="{{ $ref == $target ? '#' : url($tab) }}">{{ ucfirst($ref) }}</a>
            </li>
        @endforeach

    </ul>

</div>

