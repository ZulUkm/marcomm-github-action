@props(['name', 'label' => null, 'type' => 'text', 'value' => null, 'required' => false, 'class' => null])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger ms-1">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        class="form-control {{ $class }} @error($name) is-invalid @enderror"
        @if ($required) required @endif {{ $attributes }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
