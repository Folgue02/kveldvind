<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exercise_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('exercise_tags')->insert([
            ['name' => 'Push'],
            ['name' => 'Pull']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_tags');
    }
};
