@props(['url' => url()->previous(), 'text' => 'Back', 'class' => 'btn-secondary'])

<a href="{{ $url }}" class="btn {{ $class }} d-inline-flex align-items-center justify-content-center">
    <i class="ti ti-arrow-left me-2"></i>{{ $text }}
</a>
