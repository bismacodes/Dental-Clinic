@props([
    'label' => null,
    'name' => null,
    'value' => 1,
])

@php
    $model = $attributes->wire('model')->value();
    $field = $name ?? $model;
@endphp

<div class="mb-3 form-check">

    <input type="checkbox" id="{{ $field }}" name="{{ $field }}" value="{{ $value }}"
        {{ $attributes->merge([
            'class' => 'form-check-input ' . ($errors->has($field) ? 'is-invalid' : ''),
        ]) }}
        @checked(old($field, data_get($attributes->wire('model')->value() ? $this ?? null : null, $field)))>

    @if ($label)
        <label for="{{ $field }}" class="form-check-label">
            {{ $label }}
        </label>
    @endif

    @error($field)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror

</div>
