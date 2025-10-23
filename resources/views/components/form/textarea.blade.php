@props(['name', 'label', 'placeholder' => '', 'value' => '', 'rows' => 3, 'required' => false])

<div class="form-group mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}" id="{{ $name }}"
        name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }} {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
