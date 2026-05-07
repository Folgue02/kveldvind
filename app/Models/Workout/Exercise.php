<?php

namespace App\Models\Workout;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('name', 'description', 'icon_path', 'public', 'body_region', 'exercise_tag_id')]
class Exercise extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseTag(): BelongsTo
    {
        return $this->belongsTo(ExerciseTag::class);
    }

    public function bodyRegion(): ?ExerciseBodyRegion
    {
        return ExerciseBodyRegion::ofCode($this->body_region);
    }
}
