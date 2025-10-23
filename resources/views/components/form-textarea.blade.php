@props([
    'name',
    'value' => null,
    'required' => false,
    'placeholder' => '',
    'rows' => 3,
    'disabled' => false,
    'readonly' => false,
    'class' => '',
    'id' => null,
])

<textarea name="{{ $name }}" id="{{ $id ?? $name }}" rows="{{ $rows }}" {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} placeholder="{{ $placeholder }}"
    class="form-control {{ $class }} @error($name) is-invalid @enderror" {{ $attributes }}>{{ $value ?? $slot }}</textarea>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
