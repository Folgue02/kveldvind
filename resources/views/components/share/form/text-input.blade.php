@props([
    'name',
    'label',
    'inputType' => 'text',
    'sectionClass',
    'maxLength',
    'value' => ''
])
@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="section {{ $sectionClass ?? '' }}">
    <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
    <input
        type="{{ $inputType }}"
        name="{{ $name }}"
        {!! $attributes->has('required') ? 'required' : '' !!}
        id="{{ $inputId ??  $name }}"
        @if(isset($maxLength))
            {!! 'maxlength="' . intval($maxLength) . '"' !!}
        @endif
        value="{{ $value }}">
    @error($name) <span class="error">{{ $message }}</span> @enderror
</div>
