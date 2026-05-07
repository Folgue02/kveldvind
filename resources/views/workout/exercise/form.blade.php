@extends('layouts.main')
@use(App\Models\Workout\ExerciseBodyRegion)

@if(isset($exercise))
    @section('title', 'Edit exercise ' . $exercise->name)
@else
    @section('title', 'Create new exercise')
@endif

@push('styles')
    @vite(['resources/css/share/form.css', 'resources/css/workout/exercises/form.css'])
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


    <div class="exercise-form-container">

        <form action="{{ isset($exercise) ? route('workout.exercises.update', $exercise->id) : route('workout.exercises.store') }}" method="POST" class="form" id="exercise-form">
            @csrf
            @if(isset($exercise))
                @method('PUT')
            @endif

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
                    <input type="text" name="name" value="{{ @$exercise?->name }}" required>
                </div>
            </div>

            <div class="form-line">
                <div class="section">
                    <label for="exercise_tag_id">TAG</label>
                    <select name="exercise_tag_id">
                        <option value="">No exercise tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                    @if(@$exercise?->exercise_tag_id === $tag->id) selected @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="section">
                    <label for="body_region">Body region</label>
                    <select name="body_region">
                        <option value="">No body region</option>
                        @foreach(ExerciseBodyRegion::cases() as $bodyRegion)
                            <option value="{{ $bodyRegion->toCode() }}"
                                    @if(@$exercise?->bodyRegion() == $bodyRegion) selected @endif>
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

            <div class="form-line">
                <div class="checkbox-section">
                    <label for="public">Public</label>
                    <input type="checkbox" name="public" value="1" {{ @$exercise->public ? 'checked' : '' }}>
                </div>
            </div>
        </form>
        <div class="action-line">
            <button type="submit" form="exercise-form" class="action">@if(isset($exercise)) Save @else Create @endif</button>
            @if(isset($exercise))
                <form action="{{ route('workout.exercises.destroy', $exercise->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action danger">Delete</button>
                </form>
            @endif
        </div>
    </div>
@endsection
