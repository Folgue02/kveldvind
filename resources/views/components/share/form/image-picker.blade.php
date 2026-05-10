@props([
    'name',
    'label',
    'sectionClass' => '',
    'value' => null
])

@pushonce('styles')
    @vite(['resources/css/share/form/image-picker.css'])
@endpushonce

@pushonce('styles')
    @vite(['resources/css/share/card.css'])
@endpushonce

@pushonce('scripts')
    @vite(['resources/js/share/form/image-picker.js'])
@endpushonce

<div class="{{ @$sectionClass }} section">
    <div class="image-picker-container card"
        data-input-name="{{ $name }}"
        @if($value) data-input-value="{{ $value }}" @endif>
        {{-- Delete button, only visible when a file is loaded --}}
        <button class="image-picker-clear"
            type="button"
            style="display: none;"
            data-input-name="{{ $name }}">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <p class="label">{{ $label }}</p>
        <label for="{{ $inputId ?? $name }}">
            <span class="image-picker-icon"><i class="fa-solid fa-plus"></i></span>
            <input type="file"
                name="{{ $name }}"
                id="{{ $inputId ?? $name }}"
                class="image-input">
        </label>
        <input type="hidden" name="{{ $name }}_remove" class="image-picker-remove-flag" value="0">
        <p class="image-picker-file-name">No file selected.</p>
    </div>
</div>
