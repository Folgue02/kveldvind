@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="section">
    <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
    <input type="{{ $inputType ?? 'text' }}" name="{{ $name }}" {{ $required ? 'required' : '' }} id="{{ $inputId ??  $name }}">
    @error($name) <span class="error">{{ $message }}</span> @enderror
</div>
