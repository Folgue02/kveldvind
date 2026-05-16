<?php
namespace App\Http\Controllers\Workout;

use App\Http\Controllers\Controller;
use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseBodyRegion;
use App\Models\Workout\ExerciseTag;
use App\Services\Workout\ExerciseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    const string ICON_STORAGE_PATH = 'exercise/icons';

    public function __construct(
        private ExerciseService $exerciseService
    ) {}

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
        $this->exerciseService->saveExercise($request);

        return redirect()->route('workout.exercises.index')
            ->with('success', 'Exercise created succesfully.');
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
        $this->exerciseService->saveExercise($request, $id);

        return redirect()->route('workout.exercises.index')->with('success', 'Exercise updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->exerciseService->deleteExercise($id);
        return redirect()->route('workout.exercises.index')->with('success', 'Exercise removed successfully.');
    }
}
