@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'hasMargin' => true,
    'value' => '',
])

<div class="{{ $hasMargin ? 'mb-2 mb-md-3' : '' }}">

    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}

            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
