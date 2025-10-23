@props([
    'route' => null,
    'url' => null,
    'text' => 'Cancel',
    'confirm' => false,
    'confirmMessage' => 'Are you sure you want to cancel? Any unsaved changes will be lost.',
])

@php
    // Determine the href based on provided props
    $href = '';

    if ($route) {
        $href = route($route);
    } elseif ($url) {
        $href = $url;
    } else {
        // Default - go back to previous page
        $href = url()->previous();
    }
@endphp

@if ($confirm)
    <a href="javascript:void(0);" onclick="confirmCancel('{{ $href }}')" class="btn btn-secondary me-2"
        {{ $attributes }}>
        {{ $text }}
    </a>

    <script>
        function confirmCancel(url) {
            if (confirm('{{ $confirmMessage }}')) {
                window.location.href = url;
            }
        }
    </script>
@else
    <a href="{{ $href }}" class="btn btn-secondary me-2" {{ $attributes }}>
        {{ $text }}
    </a>
@endif
