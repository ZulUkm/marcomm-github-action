@php
    if (($status ?? 'Returnable') === 'Returnable') {
        $color = 'bg-success';
    } elseif (($status ?? 'Returnable') === 'Non-returnable') {
        $color = 'bg-secondary';
    } else {
        $color = 'bg-danger';
    }
@endphp
<span class="badge {{ $color }} fw-medium fs-10">{{ $status ?? 'Returnable' }}</span>
