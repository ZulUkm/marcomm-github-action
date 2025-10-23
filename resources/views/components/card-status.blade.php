@php
    if (($status ?? 'active') === 'active') {
        $color = 'bg-success';
    } elseif (($status ?? 'Active') === 'Inactive') {
        $color = 'bg-secondary';
    } else {
        $color = 'bg-danger';
    }
@endphp
<span class="badge {{ $color }} fw-medium fs-10">{{ $status ?? 'Active' }}</span>
