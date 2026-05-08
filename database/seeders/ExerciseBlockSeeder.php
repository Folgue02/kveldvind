<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workout\Exercise;
use App\Models\Workout\ExerciseBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demoUser = User::where('email', 'demo@demo.com')->first();
        $exercises = $demoUser->exercises()->get();

        $blockA = ExerciseBlock::create([
            'name' => 'Block A',
            'description' => 'Description for block A',
            'alias' => 'A',
            'public' => 0,
            'author_id' => $demoUser->id
        ]);

        $blockB = ExerciseBlock::create([
            'name' => 'Block B',
            'description' => 'Description for block B',
            'alias' => 'B',
            'public' => 0,
            'author_id' => $demoUser->id
        ]);

        foreach ($exercises as $index => $exercise) {
            $assignedBlock = $exercise->count() / 2 > $index
                ? $blockA
                : $blockB;

            $assignedBlock->exerciseBlockDetails()->create([
                'exercise_id' => $exercise->id,
                'series' => rand(1, 3),
                'min_reps' => 8,
                'max_reps' => 12
            ]);
        }
    }
}
