<?php

namespace App\Http\Controllers\Workout;

use App\Http\Controllers\Controller;
use App\Models\Workout\ExerciseBlock;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExerciseBlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $exerciseBlocks = $request->user()->exerciseBlocks()->get();
        return view('workout.exercise-block.index', compact('exerciseBlocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alias' => 'nullable|string|max:8',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:60000',
        ]);
        $validated['alias'] = strtoupper($validated['alias'] ?? '');
        $validated['author_id'] = $request->user()->id;

        ExerciseBlock::create($validated);
        return redirect()->route('workout.exercises.blocks.index')
            ->with('success', 'Exercise block created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exerciseBlock = ExerciseBlock::findOrFail($id);
        return view('workout.exercise-block.form', compact('exerciseBlock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'alias' => 'nullable|string|max:8',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:60000',
        ]);
        $validated['alias'] = strtoupper($validated['alias']);
        $validated['author_id'] = $request->user()->id;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExerciseBlock::destroy($id);
        return redirect()->route('workout.exercises.blocks.index')
            ->with('success', 'Exercise block removed.');
    }
}
