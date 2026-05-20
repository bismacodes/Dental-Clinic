@props([
    'label' => null,
    'name' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'required' => false,
    'hasMargin' => true,
    'selected' => null,
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

    <select id="{{ $name }}" name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'form-select ' . ($errors->has($name) ? 'is-invalid' : ''),
        ]) }}>

        @if ($placeholder)
            <option value="" disabled {{ old($name, $selected) ? '' : 'selected' }}>
                {{ $placeholder }}
            </option>
        @endif

        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach

    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
