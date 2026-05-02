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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->default('');
            $table->string('icon_path')->nullable();
            $table->foreignId('author_id')->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('exercise_tag_id')->nullable;
            $table->integer('body_region')->nullable();
            $table->tinyInteger('public')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
