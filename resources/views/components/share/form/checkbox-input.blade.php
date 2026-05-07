@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="checkbox-section">
    <input type="checkbox" name="{{ $name }}" id="{{ $inputId ?? $name }}">
    <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
</div>
