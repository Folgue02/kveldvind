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
            <a href="{{ route('workout.exercises.index') }}" class="action"><i class="fa-solid fa-arrow-left"></i> Go back to the listing</a>
        </x-slot:right>
    </x-share.page-header>


    <div class="exercise-form-container">

        <form action="{{ isset($exercise) ? route('workout.exercises.update', $exercise->id) : route('workout.exercises.store') }}" method="POST" class="form" id="exercise-form">
            @csrf
            @if(isset($exercise))
                @method('PUT')
            @endif

            <div class="form-line">
                <x-share.form.image-picker
                    name="icon"
                    label="icon"
                    section-class="icon-section"
                    />
                <x-share.form.text-input
                    name="name"
                    label="name"
                    :value="old('name', @$exercise->name)"
                    section-class="name-section"
                    required="true"/>
            </div>

            <div class="form-line">
                <x-share.form.select-input
                    name="exercise_tag_id"
                    label="Tag"
                    default-option-label="No exercise tag"
                    :options="$tags->mapWithKeys(fn($t) => [$t->id => $t->name])->toArray()"
                    :selected="old('exercise_tag_id', @$exercise->exercise_tag_id)"/>
                <x-share.form.select-input
                    name="body_region"
                    label="Body region"
                    default-option-label="Unknown body region"
                    :options="array_reduce(ExerciseBodyRegion::cases(), fn($carry, $br) => $carry + [$br->toCode() => $br->naturalName()], [])"
                    :selected="old('body_region', @$exercise->body_region)"/>
            </div>

            <div class="form-line">
                <x-share.form.textarea-input
                    name="description"
                    label="description"
                    rows="10"
                    :value="old('description', @$exercise->description)"/>
            </div>

            <div class="attachments-line">
                {{-- TODO --}}
            </div>

            <div class="form-line">
                <x-share.form.checkbox-input
                    name="public"
                    label="public"
                    :selected="old('public', @$exercise->public == 1)"
                    />
            </div>
        </form>
        <div class="action-line">
            @if(isset($exercise))
                <form action="{{ route('workout.exercises.destroy', $exercise->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action danger"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            @endif
            <button type="submit" form="exercise-form" class="action">
                 <i class="fa-solid fa-floppy-disk"></i> @if(isset($exercise)) Save @else Create @endif
            </button>
        </div>
    </div>
@endsection
