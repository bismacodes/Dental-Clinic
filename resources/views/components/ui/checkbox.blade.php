@props([
    'label' => '',
    'name',
    'value' => 1,
    'checked' => false,
    'required' => false,
    'hasMargin' => true,
])

<div class="form-check {{ $hasMargin ? 'mb-2 mb-md-3' : '' }}">

    <input type="checkbox" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}"
        @checked(old($name, $checked)) {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'form-check-input ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}>

    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}

        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror

</div>
