@props([
    'label' => null,
    'name' => null,
    'placeholder' => '',
    'rows' => 3,
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

    <textarea id="{{ $name }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}>{{ old($name, $value) }}</textarea>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
