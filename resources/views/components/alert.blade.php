<!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/components/alert.blade.php -->
@props(['type' => null, 'message' => null, 'dismissible' => true])

@php
    // Auto-detect type if not provided explicitly
    if (!$type) {
        if (session()->has('success')) $type = 'success';
        elseif (session()->has('error')) $type = 'error';
        elseif (session()->has('warning')) $type = 'warning';
        else $type = 'info';
    }
    
    $alertClass = match($type) {
        'success' => 'alert-success',
        'error', 'danger' => 'alert-danger',
        'warning' => 'alert-warning',
        default => 'alert-primary'
    };
    
    $icon = match($type) {
        'success' => 'feather-check-circle',
        'error', 'danger' => 'feather-alert-octagon',
        'warning' => 'feather-alert-triangle',
        default => 'feather-info'
    };
    
    // Check if there's a message or session values
    $hasContent = $message || session('success') || session('error') || session('warning') || !$slot->isEmpty();
    $content = $message ?? session('success') ?? session('error') ?? session('warning') ?? ($slot->isEmpty() ? null : $slot);
@endphp

@if($hasContent)
    <div class="alert {{ $alertClass }} d-flex align-items-center" role="alert">
        <i class="{{ $icon }} flex-shrink-0 me-2"></i>
        <div>
            {{ $content }}
        </div>
        @if($dismissible)
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
@endif