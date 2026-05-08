<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $demoUser = User::where('email', 'demo@demo.com')->first();

        if (!$demoUser)
            User::factory()->create([
                'name' => 'Demo User',
                'email' => 'demo@demo.com',
                'password' => Hash::make('password123')
            ]);

        $this->call(ExerciseSeeder::class);
        $this->call(ExerciseBlockSeeder::class);
    }
}
