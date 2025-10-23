@props([
    'name' => 'quantity',
    'label' => 'Quantity',
    'value' => 1,
    'min' => 1,
    'required' => false,
    'maxWidth' => '200px',
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

    <div class="input-group quantity-group" style="max-width: {{ $maxWidth }};">
        <button class="btn btn-outline-primary quantity-btn decrease-btn" type="button"
            data-input="{{ $name }}">−</button>

        <input type="number" id="{{ $name }}" name="{{ $name }}"
            class="form-control text-center quantity-input @error($name) is-invalid @enderror"
            value="{{ old($name, $value) }}" min="{{ $min }}" @if ($required) required @endif
            {{ $attributes }}>

        <button class="btn btn-outline-primary quantity-btn increase-btn" type="button"
            data-input="{{ $name }}">+</button>
    </div>

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the specific input group for this component instance
        const input = document.getElementById('{{ $name }}');
        const group = input.closest('.quantity-group');
        const decreaseBtn = group.querySelector('.decrease-btn');
        const increaseBtn = group.querySelector('.increase-btn');

        // Add click event for increase button
        increaseBtn.addEventListener("click", () => {
            input.value = parseInt(input.value) + 1;
            input.dispatchEvent(new Event('change', {
                bubbles: true
            }));
        });

        // Add click event for decrease button
        decreaseBtn.addEventListener("click", () => {
            const min = parseInt(input.getAttribute('min') || 1);
            if (parseInt(input.value) > min) {
                input.value = parseInt(input.value) - 1;
                input.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            }
        });
    });
</script>
