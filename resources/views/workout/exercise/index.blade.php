@extends('layouts.main')

@section('title', 'Exercise list')

@push('styles')
    @vite(['resources/css/workout/exercises/listing.css'])
    @vite(['resources/css/share/card.css'])
@endpush

@section('content')
    <x-share.page-header>
        <x-slot:left>
            <h2 class="title">Your exercises ({{ $exercises->count() }})</h2>
        </x-slot:left>

        <x-slot:right>
            <a href="{{ route('workout.exercises.create') }}" class="action"><i class="fa-solid fa-plus"></i> Create exercise</a>
        </x-slot:right>
    </x-share.page-header>

    <div class="exercises">
        @forelse($exercises as $exercise)
            <x-workout.exercises.card :exercise="$exercise"/>
        @empty
            <p>No exercises, create one <a href="{{ route('workout.exercises.create') }}">here</a></p>
        @endforelse
    </div>
@endsection
