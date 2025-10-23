<!-- filepath: /Users/zulfaris/Desktop/ukm sistem/marcomm/resources/views/components/status-badge.blade.php -->

@props(['status', 'size' => 'sm'])

@php
    $statusConfig = [
        'Pending' => [
            'class' => 'bg-warning text-dark',
            'icon' => 'ti ti-clock',
            'text' => 'Pending'
        ],
        'Approved' => [
            'class' => 'bg-success text-white',
            'icon' => 'ti ti-check-circle',
            'text' => 'Approved'
        ],
        'Processing' => [
            'class' => 'bg-info text-white',
            'icon' => 'ti ti-loader',
            'text' => 'Processing'
        ],
        'Completed' => [
            'class' => 'bg-primary text-white',
            'icon' => 'ti ti-circle-check',
            'text' => 'Completed'
        ],
        'Rejected' => [
            'class' => 'bg-danger text-white',
            'icon' => 'ti ti-x-circle',
            'text' => 'Rejected'
        ],
        'Cancelled' => [
            'class' => 'bg-secondary text-white',
            'icon' => 'ti ti-ban',
            'text' => 'Cancelled'
        ],
        'Returned' => [
            'class' => 'bg-orange text-white',
            'icon' => 'ti ti-arrow-back',
            'text' => 'Returned'
        ],
        'On Hold' => [
            'class' => 'bg-dark text-white',
            'icon' => 'ti ti-pause',
            'text' => 'On Hold'
        ]
    ];

    $config = $statusConfig[$status] ?? [
        'class' => 'bg-secondary text-white',
        'icon' => 'ti ti-help',
        'text' => $status ?? 'Unknown'
    ];

    $sizeClass = match($size) {
        'xs' => 'badge-xs px-2 py-1 fs-10',
        'sm' => 'badge-sm px-2 py-1 fs-11',
        'md' => 'badge-md px-3 py-2 fs-12',
        'lg' => 'badge-lg px-4 py-2 fs-14',
        default => 'badge-sm px-2 py-1 fs-11'
    };
@endphp

<span class="badge {{ $config['class'] }} {{ $sizeClass }} rounded-pill d-inline-flex align-items-center gap-1" 
      title="{{ $config['text'] }}" 
      {{ $attributes }}>
    <i class="{{ $config['icon'] }} fs-10"></i>
    <span>{{ $config['text'] }}</span>
</span>

<style>
.bg-orange {
    background-color: #fd7e14 !important;
}

.badge-xs {
    font-size: 0.65rem;
    padding: 0.15rem 0.4rem;
}

.badge-sm {
    font-size: 0.7rem;
    padding: 0.25rem 0.5rem;
}

.badge-md {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
}

.badge-lg {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

.fs-10 { font-size: 0.625rem !important; }
.fs-11 { font-size: 0.6875rem !important; }
</style>