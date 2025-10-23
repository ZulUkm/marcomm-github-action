@props([
    'name',
    'label' => null,
    'options' => [],
    'selected' => null,
    'required' => false,
    'placeholder' => 'Select an option',
    'class' => null,
])

<div class="mb-3">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger ms-1">*</span>
            @endif
        </label>
    @endif

    <select id="{{ $name }}" name="{{ $name }}"
        class="select {{ $class }} @error($name) is-invalid @enderror"
        @if ($required) required @endif {{ $attributes }}>
        <option value="">{{ $placeholder }}</option>

        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
