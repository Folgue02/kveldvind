<?php
namespace App\Models\Workout;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('exercise_id', 'exercise_block_id', 'series', 'min_reps', 'max_reps')]
class ExerciseBlockDetail extends Model
{
    public function exerciseBlock(): BelongsTo
    {
        return $this->belongsTo(ExerciseBlock::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
