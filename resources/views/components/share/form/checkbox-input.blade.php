@props([
    'name',
    'label',
    'inputId',
    'value' => 1,
    'selected' => false,
])
@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="checkbox-section">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $inputId ?? $name }}"
           value="{{ $value ?? 1 }}"
           {{ ($selected ?? false) === true ? 'checked' : '' }}>
    <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
</div>
