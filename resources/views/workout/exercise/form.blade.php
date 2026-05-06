@extends('layouts.main')
@use(App\Models\Workout\ExerciseBodyRegion)

@if(isset($exercise))
    @section('title', 'Edit exercise ' . $exercise->name)
@else
    @section('title', 'Create new exercise')
@endif

@push('styles')
    @vite(['resources/css/share/form.css'])
    @vite(['resources/css/workout/exercises/form.css'])
@endpush

@section('content')
    <x-share.page-header>
        <x-slot:left>
            <h2 class="title">
                @if(isset($exercise))
                    Edit exercise '{{ $exercise->name }}'
                @else
                    Create new exercise
                @endif
            </h2>
        </x-slot:left>
        <x-slot:right>
            <a href="{{ route('workout.exercises.index') }}" class="action">Go back to the listing</a>
        </x-slot:right>
    </x-share.page-header>

    <form action="{{ route('workout.exercises.store') }}" method="POST" class="form exercise-form">
        @csrf

        <div class="form-line">
            <div class="section icon-section">
                <label>ICON</label>
                <label for="icon" class="image-picker">
                    {{-- TODO: Create functional image picker --}}
                    <input type="file" name="icon" accept="image/png, image/jpeg">
                </label>
            </div>
            <div class="section">
                <label for="name">NAME</label>
                <input type="text" name="name" value="{{ @$exercise?->name }}">
            </div>
        </div>

        <div class="form-line">
            <div class="section">
                <label for="exercise_tag">TAG</label>
                <select name="exercise_tag">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                                @if(@$exercise?->exercise_tag_id === $tag->id) selected @endif>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="section">
                <label for="exercise_body_region">Body region</label>
                <select name="exercise_body_region">
                    @foreach(ExerciseBodyRegion::cases() as $bodyRegion)
                        <option value="{{ $bodyRegion->toCode() }}"
                                @if(@$exercise?->body_region() == $bodyRegion) selected @endif>
                            {{ $bodyRegion->naturalName() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-line">
            <div class="section">
                <label for="description">description</label>
                <textarea name="description" rows="10">{{ @$exercise?->description }}</textarea>
            </div>
        </div>

        <div class="attachments-line">
            {{-- TODO --}}
        </div>

        <div class="action-line">
            <button type="submit" class="action">@if(isset($exercise)) Save @else Create @endif</button>
            @if(isset($exercise))
                <a href="#" class="action">Delete</a>
            @endif
        </div>
    </form>
@endsection
