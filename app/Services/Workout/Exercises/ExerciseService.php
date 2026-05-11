<?php
namespace App\Services\Workout\Exercises;

use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseBodyRegion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseService {
    const string ICON_STORAGE_PATH = 'exercises/icons';

    public function saveExercise(Request $request, ?int $exerciseId = null): Exercise
    {
        $data = $this->validateExercise($request);
        if ($exerciseId) {
            // Update an already existing exercise
            $exercise = Exercise::findOrFail($exerciseId);

            // If a new icon is specified, the old icon gets updated in the database,
            // and the old one gets removed. The icon might also get removed if 'icon_remove'
            // is set to 1 in the request.
            if ($request->hasFile('icon'))
                $data['icon_path'] = $this->storeIconInStorage($request);

            if ($exercise->icon_path && ($data['icon_remove'] == 1 || $request->hasFile('icon')))
                $this->deleteIconFromStorage($exercise->icon_path, $data);

            $exercise->update($data);

            return $exercise;
        } else {
            // Creating a new exercise
            if ($request->hasFile('icon')) {
                $iconPath = $this->storeIconInStorage($request);
                $data['icon_path'] = $iconPath;
            }

            return $request->user()->exercises()->create($data);
        }
    }

    public function deleteExercise(string|int $id)
    {
        $exercise = Exercise::findOrFail($id);

        if ($exercise->icon_path)
            $this->deleteIconFromStorage($exercise->icon_path);

        $exercise->delete();
    }

    private function validateExercise(Request $request): array
    {
        $bodyRegionIds = array_map(fn($bodyRegion) => $bodyRegion->toCode(), ExerciseBodyRegion::cases());
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65000',
            'exercise_tag_id' => 'nullable|integer|exists:exercise_tags,id',
            'body_region' => 'nullable|integer|in:' . implode(',', $bodyRegionIds),
            'public' => 'nullable|integer|in:1',
            'icon' => 'nullable|file|mimetypes:image/jpeg,image/png|max:5120',
            'icon_remove' => 'nullable|integer|in:1,0'
        ]);
    }

    private function storeIconInStorage(Request $request): string
    {
        return $request->file('icon')->store(self::ICON_STORAGE_PATH, 'public');
    }

    private function deleteIconFromStorage(string $iconPath, mixed &$exerciseData = null)
    {
        if ($exerciseData) $exerciseData['icon_path'] = null;
        Storage::disk('public')->delete($iconPath);
    }
}
