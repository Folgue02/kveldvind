@extends('layouts.main')

@section('title', 'Exercise blocks')

@pushonce('styles')
    @vite(['resources/css/workout/exerciseBlocks/listing.css'])
@endpushonce

@section('content')
    <x-share.page-header>
        <x-slot:left>
            <h2 class="title">Your exercise blocks ({{ $exerciseBlocks->count() }})</h2>
        </x-slot:left>

        <x-slot:right>
            <a href="{{ route('workout.exercises.blocks.form') }}" class="action">+ Create exercise block</a>
        </x-slot:right>
    </x-share.page-header>

    <div class="exercise-blocks">
        @forelse($exerciseBlocks as $exerciseBlock)
            <a class="exercise-block" href="{{ route('workout.exercises.blocks.edit', $exerciseBlock->id) }}">
                <div class="exercise-block-header">
                    @if($exerciseBlock->alias)
                        <span class="alias">{{ $exerciseBlock->alias }}</span> -
                    @endif
                    <h3>{{ $exerciseBlock->name }}</h3>
                </div>
                <p class="description">
                    <i>
                        @if($exerciseBlock->exerciseBlockDetails()->get()->isEmpty())
                            0 exercises
                        @else
                            {{ $exerciseBlock->exerciseBlockDetails()->get()->count() }} exercise(s)
                        @endif
                    </i>
                    -
                    @if($exerciseBlock->description)
                        {{ $exerciseBlock->description }}
                    @else
                        <i>No description given.</i>
                    @endif
                </p>
            </a>
        @empty
            <p>No exercise block. You can start by creating one <a href="#">here</a>.</p>
        @endforelse
    </div>
@endsection
