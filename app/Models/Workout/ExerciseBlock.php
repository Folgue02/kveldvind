<?php

namespace App\Models\Workout;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('name', 'description', 'alias', 'public', 'author_id')]
class ExerciseBlock extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseBlockDetails(): HasMany
    {
        return $this->hasMany(ExerciseBlockDetail::class);
    }
}
