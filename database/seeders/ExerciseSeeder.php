<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseTag;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * @throws \Exception If the demo user is missing
     */
    public function run(): void
    {
        $demoUser = User::where('email', 'demo@demo.com')->first();
        $pushTag = ExerciseTag::where('name', 'Push')->first();

        if (!$demoUser)
            throw new \Exception('demo@demo.com user is not in the database, can\'t create exercises without a user.');

        $exercises = [
            ['name' => 'Bench Press', 'description' => 'Barbell press performed lying on a flat bench, targeting the chest, shoulders, and triceps.'],
            ['name' => 'Overhead Press', 'description' => 'Standing or seated barbell press above the head, targeting the shoulders and triceps.'],
            ['name' => 'Incline Dumbbell Press', 'description' => 'Dumbbell press on an inclined bench, emphasising the upper chest.'],
            ['name' => 'Push-Up', 'description' => 'Bodyweight press from the floor, targeting the chest, shoulders, and triceps.'],
            ['name' => 'Tricep Dip', 'description' => 'Bodyweight dip on parallel bars or a bench, isolating the triceps.'],
            ['name' => 'Lateral Raise', 'description' => 'Dumbbell raise to the sides, isolating the lateral head of the deltoid.'],
        ];

        foreach ($exercises as $data) {
            Exercise::create([
                ...$data,
                'author_id' => $demoUser->id,
                'exercise_tag_id' => $pushTag?->id,
                'public' => 1,
            ]);
        }
    }
}
