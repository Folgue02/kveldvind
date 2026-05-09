@props([
    'name',
    'label',
    'inputId',
    'rows' => 10,
    'value' => '',
])
@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="section">
    <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $inputId ?? $name }}" rows="{{ $rows ?? 10 }}">{{ $value ?? '' }}</textarea>
</div>
