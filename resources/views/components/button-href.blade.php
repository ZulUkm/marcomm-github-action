@props(['href' => '#', 'text' => 'Add Sales', 'isModal' => false, 'modalTarget' => '', 'class' => 'btn-primary'])

<div class="page-btn">
    <a href="{{ $href }}" class="btn {{ $class }}"
        @if ($isModal) data-bs-toggle="modal" 
         data-bs-target="{{ $modalTarget }}" @endif>
        <i class="ti ti-circle-plus me-1"></i>{{ $text }}
    </a>
</div>
