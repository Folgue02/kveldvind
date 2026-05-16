@props([
    'name',
    'label',
    'maxFiles' => 1,
    'minFiles' => 0,
    'value' => []
])

@pushonce('styles')
    @vite('resources/css/share/form/multi-image-picker.css')
@endpushonce

@pushonce('styles')
    @vite('resources/css/share/form.css')
@endpushonce

@pushonce('scripts')
    @vite('resources/js/share/form/multi-image-picker.js')
@endpushonce
<div class="section">
    <div class="multi-image-picker-container"
        data-max-files="{{ $maxFiles }}"
        data-min-files="{{ $minFiles }}"
        data-input-name="{{ $name }}"
        data-input-value="{{ !empty($value) ? implode(',', $value) : '' }}">
        <p class="label">{{ $label }}</p>
        <div class="image-previews">
            <label for="{{ $inputId ?? $name }}">
                <div class="image-preview default-preview">
                    <span><i class="fa-solid fa-plus"></i></span>
                </div>
                <input type="file" name="{{ $name }}[]" multiple id="{{ $inputId ?? $name }}">
            </label>
            <input type="hidden" name="remove-{{ $name }}">
        </div>
    </div>
    @error($name . '[]') <span class="danger">{{ $message }}</span> @enderror
</div>
