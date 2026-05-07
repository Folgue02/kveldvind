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
        Schema::create('exercise_block_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exercise_id');
            $table->foreignId('exercise_block_id');
            $table->integer('series');
            $table->integer('min_reps');
            $table->integer('max_reps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_block_details');
    }
};
