@props(['label' => '', 'name', 'type' => 'text', 'value' => '', 'placeholder' => ''])

@if ($label)
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
@endif

@if ($type === 'password')
    <div class="pass-group">
        <input type="password" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'form-control pass-input' . ($errors->has($name) ? ' is-invalid' : '')]) }}>
        <span class="ti toggle-password ti-eye-off text-gray-9"></span>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@else
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
@endif
