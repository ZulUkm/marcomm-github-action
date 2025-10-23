@props(['value'])

@if ($value)
    <span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10">
        <i class="ti ti-point-filled me-1 fs-11"></i>Active
    </span>
@else
    <span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10">
        <i class="ti ti-point-filled me-1 fs-11"></i>Inactive
    </span>
@endif
