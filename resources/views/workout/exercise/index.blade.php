<h2>Your exercises</h2>

<div class="exercises">
    @forelse($exercises as $exercise)
        <div class="card card-exercise" data-name="{{ $exercise->name }}">
            <img class="exercise-icon" src="{{ Storage::url($exercise->icon_path ?? 'default-icon.png') }}" alt="{{ $exercise->name }}">
            <h4 class="exercise-title">{{ $exercise->name }}</h4>
            <p class="exercise-description">{{ $exercise->description }}</p>
            <div class="delete-exercise">🗑</div>️
        </div>
    @empty
        <p>No exercises, create one <a href="#">here</a></p>
    @endforelse
</div>
