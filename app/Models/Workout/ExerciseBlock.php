<?php

namespace App\Models\Workout;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'description', 'alias', 'public'])]
class ExerciseBlock extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
