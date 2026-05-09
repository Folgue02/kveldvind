<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Workout\ExerciseController;
use App\Http\Controllers\Workout\ExerciseBlockController;

// Home
Route::view('/', 'home')->name('home');
Route::redirect('/home', '/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ====================
// Workout related
// ====================

// Exercises
Route::controller(ExerciseController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/exercises', 'index')
            ->name('workout.exercises.index');

        Route::get('/exercises/create', 'create')
            ->name('workout.exercises.create');

        Route::post('/exercises/create', 'store')
            ->name('workout.exercises.store');

        Route::get('/exercises/edit/{id}', 'edit')
            ->name('workout.exercises.edit');

        Route::put('/exercise/edit/{id}', 'update')
            ->name('workout.exercises.update');

        Route::get('/exercises/destroy/{id}', 'destroy')
            ->name('workout.exercises.destroy');
    });
});

Route::controller(ExerciseBlockController::class)->group(function () {
    Route::middleware('auth')->group(function() {
        Route::get('/exercises/blocks', 'index')
            ->name('workout.exercises.blocks.index');

        Route::view('/exercises/blocks/create', 'workout.exercise-block.form')
            ->name('workout.exercises.blocks.form');

        Route::post('/exercises/blocks/create', 'store')
            ->name('workout.exercises.blocks.store');

        Route::get('/exercises/blocks/edit/{id}', 'edit')
            ->name('workout.exercises.blocks.edit');

        Route::put('/exercises/blocks/edit/{id}', 'update')
            ->name('workout.exercises.blocks.update');

        Route::delete('/exercise/blocks/destroy/{id}', 'destroy')
            ->name('workout.exercises.blocks.destroy');
    });
});
