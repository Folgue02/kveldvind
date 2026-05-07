<?php

namespace App\Http\Controllers\Workout;

use App\Http\Controllers\Controller;
use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseBodyRegion;
use App\Models\Workout\ExerciseTag;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $exercises = $request->user()->exercises()->get();

        return view('workout.exercise.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = ExerciseTag::all();
        return view('workout.exercise.form', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bodyRegionIds = array_map(fn($bodyRegion) => $bodyRegion->toCode(), ExerciseBodyRegion::cases());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65000',
            'exercise_tag_id' => 'nullable|integer|exists:exercise_tags,id',
            'body_region' => 'nullable|integer|in:' . implode(',', $bodyRegionIds),
            'public' => 'nullable|integer|in:1'
        ]);

        $request->user()->exercises()->create($validated);

        return redirect()->route('workout.exercises.index')->with('success', 'Exercise created succesfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tags = ExerciseTag::all();
        return view('workout.exercise.form', ['exercise' => Exercise::findOrFail($id), 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bodyRegionIds = array_map(fn($bodyRegion) => $bodyRegion->toCode(), ExerciseBodyRegion::cases());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65000',
            'exercise_tag_id' => 'nullable|integer|exists:exercise_tags,id',
            'body_region' => 'nullable|integer|in:' . implode(',', $bodyRegionIds),
            'public' => 'nullable|integer|in:1'
        ]);

        Exercise::findOrFail($id)->update($validated);
        return redirect()->route('workout.exercises.index')->with('success', 'Exercise updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Exercise::findOrFail($id)->delete();
        return redirect()->route('workout.exercises.index')->with('success', 'Exercise removed successfully.');
    }
}
