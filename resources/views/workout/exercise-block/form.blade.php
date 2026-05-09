@extends('layouts.main')

@if(isset($exerciseBlock))
    @section('title', 'Edit block')
@else
    @section('title', 'Create new block')
@endif

@push('styles')
    @vite(['resources/css/workout/exerciseBlocks/form.css'])
@endpush

@section('content')
    <x-share.page-header>
        <x-slot:left>
            <h2 class="title">
                @if(isset($exerciseBlock))
                    Edit exercise '{{ $exerciseBlock->name }}'
                @else
                    New exercise
                @endif
            </h2>
        </x-slot:left>
        <x-slot:right>
            <a href="{{ route('workout.exercises.blocks.index') }}" class="action">Go back to the listing</a>
        </x-slot:right>
    </x-share.page-header>

    <div class="exercise-block-form-container">
        <form action="" class="form" id="exercise-block-form" method="POST">
            @if(isset($exerciseBlock))
                @method('PUT')
            @endif

            <div class="form-line">
                <x-share.form.text-input
                    name="alias"
                    label="alias"
                    max-length="8"
                    section-class="alias-section"
                    :value="old('alias', @$exerciseBlock->alias)"/>
                <x-share.form.text-input
                    name="name"
                    label="name"
                    required="true"
                    :value="old('name', @$exerciseBlock->name)"/>
            </div>

            <div class="form-line">
                <x-share.form.textarea-input
                    name="description"
                    label="description"
                    :value="old('description', @$exerciseBlock->description)"
                />
            </div>
        </form>

        <div class="action-line">
            @if(isset($exerciseBlock))
                <form action="{{ route('workout.exercises.blocks.destroy', $exerciseBlock->id) }}" method="POST">
                    @method('DELETE')
                    <button type="submit" class="action danger">Delete</button>
                </form>
            @endif
            <button type="submit" class="action" form="exercise-block-form">
                @if(isset($exerciseBlock))
                    Save
                @else
                    Create
                @endif
            </button>
        </div>
    </div>
@endsection
