@props([
    'route' => null,
    'url' => null,
    'text' => 'Add New',
    'icon' => 'ti-circle-plus',
    'modal' => null,
    'buttonClass' => 'btn-primary',
])

@php
    // Determine the href based on provided props
    $href = '#';

    if ($route) {
        $href = route($route);
    } elseif ($url) {
        $href = $url;
    }

    // Determine if this button opens a modal
    $hasModal = $modal !== null;
    $modalAttributes = $hasModal ? "data-bs-toggle=\"modal\" data-bs-target=\"#{$modal}\"" : '';
@endphp

<div class="page-btn">
    <a href="{{ $href }}" class="btn {{ $buttonClass }} {{ $attributes->get('class') }}" {!! $modalAttributes !!}
        {{ $attributes->except(['class']) }}>
        <i class="ti {{ $icon }} me-1"></i>{{ $text }}
    </a>
</div>
