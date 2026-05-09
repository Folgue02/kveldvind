@props([
    'name',
    'label',
    'options',
    'inputId',
    'selected',
    'defaultOptionLabel',
    'defaultOptionValue' => '',
    'defaultDisabled',
])
@pushonce('styles')
    @vite(['resources/css/share/form.css'])
@endpushonce
<div class="section">
    <div class="section">
        <label for="{{ $inputId ?? $name }}">{{ $label }}</label>
        <select name="{{ $name }}" id="{{ $inputId ?? $name }}">
            @if(isset($defaultOptionLabel))
                <option value="{{ $defaultOptionValue ?? '' }}" {{ @$defaultDisabled == 'true' ? 'disabled' : '' }} {{ !isset($selected) ? 'selected' : '' }}>
                    {{ $defaultOptionLabel ?? 'None selected' }}
                </option>
            @endif
            @foreach($options as $optionValue => $optionName)
                <option value="{{ $optionValue }}" {{ $selected == $optionValue ? 'selected' : '' }}>{{ $optionName }}</option>
            @endforeach
        </select>
    </div>
</div>
