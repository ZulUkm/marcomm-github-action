@props(['name', 'label' => null, 'options' => [], 'selected' => null, 'required' => false])

<div class="mb-3">
    @if ($label)
        <label class="form-label mb-2">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="d-flex flex-column gap-2 ms-2">
        <div>
            @foreach ($options as $value => $optionLabel)
                <input type="radio" class="btn-check @error($name) is-invalid @enderror" name="{{ $name }}"
                    id="{{ $name }}_{{ $value }}" value="{{ $value }}"
                    {{ old($name, $selected) == $value ? 'checked' : '' }} autocomplete="off"
                    @if ($required) required @endif {{ $attributes }}>
                <label
                    class="btn {{ in_array($value, [1, 'active', 'returnable', true]) ? 'btn-outline-success' : 'btn-outline-secondary' }} w-40"
                    for="{{ $name }}_{{ $value }}">
                    {{ $optionLabel }}
                </label>
            @endforeach
        </div>

        @error($name)
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
