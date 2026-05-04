<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseBodyRegion;
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
        $pullTag = ExerciseTag::where('name', 'Pull')->first();


        if (!$demoUser)
            throw new \Exception('demo@demo.com user is not in the database, can\'t create exercises without a user.');

        $exercises = [
            ['name' => 'Bench Press', 'description' => 'Barbell press performed lying on a flat bench, targeting the chest, shoulders, and triceps.', 'body_region' => ExerciseBodyRegion::UPPER_BODY->toCode()],
            ['name' => 'Overhead Press', 'description' => 'Standing or seated barbell press above the head, targeting the shoulders and triceps.', 'body_region' => ExerciseBodyRegion::UPPER_BODY->toCode(), 'exercise_tag_id' => $pullTag?->id],
            ['name' => 'Incline Dumbbell Press', 'description' => 'Dumbbell press on an inclined bench, emphasising the upper chest.', 'exercise_tag_id' => $pullTag?->id],
            ['name' => 'Push-Up', 'description' => 'Bodyweight press from the floor, targeting the chest, shoulders, and triceps.', 'exercise_tag_id' => $pushTag?->id],
            ['name' => 'Tricep Dip', 'description' => 'Bodyweight dip on parallel bars or a bench, isolating the triceps.'],
            ['name' => 'Lateral Raise', 'description' => 'Dumbbell raise to the sides, isolating the lateral head of the deltoid.', 'exercise_tag_id' => $pushTag?->id],
            ['name' => 'Squats', 'description' => 'Same movement as in seating down on a chair.', 'body_region' => ExerciseBodyRegion::LOWER_BODY->toCode()]
        ];

        foreach ($exercises as $data) {
            Exercise::create([
                ...$data,
                'author_id' => $demoUser->id,
                'public' => 1,
            ]);
        }
    }
}
