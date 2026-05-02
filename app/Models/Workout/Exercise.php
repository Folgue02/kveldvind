<?php

namespace App\Models\Workout;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'description', 'icon_path', 'public', 'body_region')]
class Exercise extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exerciseTag()
    {
        return $this->hasOne(ExerciseTag::class);
    }

    public function bodyRegion(): ExerciseBodyRegion
    {
        return ExerciseBodyRegion::ofCode($this->body_region);
    }
}
