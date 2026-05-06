@pushOnce('styles')
    @vite(['resources/css/share/header.css'])
@endPushOnce

<div class="header">
    <div class="left">
        {{ $left }}
    </div>

    @if (isset($right))
        <div class="right">
            {{ $right }}
        </div>
    @endif
</div>
