@extends('layouts.main')

@section('title', 'Exercise list')

@push('styles')
    @vite(['resources/css/workout/exercises/listing.css'])
    @vite(['resources/css/share/card.css'])
@endpush

@section('content')
    <h2>Your exercises</h2>

    <div class="exercises">
        @forelse($exercises as $exercise)
            <div class="card card-lift-hover card-exercise" data-name="{{ $exercise->name }}">
                <div class="exercise-header">
                    <img class="exercise-icon" src="{{ $exercise->icon_path ? Storage::url($exercise->icon_path) : '/assets/default-exercise-icon.png' }}" alt="{{ $exercise->name }}">
                    <h4 class="exercise-title">{{ $exercise->name }}</h4>
                    <div class="delete-exercise">🗑</div>️
                </div>
                <p class="exercise-description">{{ $exercise->description }}</p>

            </div>
        @empty
            <p>No exercises, create one <a href="#">here</a></p>
        @endforelse
    </div>
@endsection
