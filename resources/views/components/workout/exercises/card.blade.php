<div class="card-exercise card card-lift-hover" data-name="{{ $exercise->name }}">
    <div class="exercise-header">
        <img class="exercise-icon"
             src="{{ $exercise->icon_path ? Storage::url($exercise->icon_path) : '/assets/default-exercise-icon.png' }}"
             alt="{{ $exercise->name }}">
        <h4 class="exercise-title">{{ $exercise->name }}</h4>
        <div class="delete-exercise">🗑</div>
    </div>
    <p class="exercise-description">{{ $exercise->description }}</p>
    <div class="tag-line">
        @if($exercise->exerciseTag)
            <p class="exercise-tag">{{ $exercise->exerciseTag->name }}</p>
        @endif
        @if($exercise->bodyRegion())
            <p class="exercise-body-region">{{ $exercise->bodyRegion()->naturalName() }}</p>
        @endif
    </div>
</div>
