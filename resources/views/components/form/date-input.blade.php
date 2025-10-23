@props(['name', 'label', 'value' => '', 'required' => false])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="date" class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} {{ $attributes }}>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
