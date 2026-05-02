<?php

namespace App\Models\Workout;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name')]
class ExerciseTag extends Model
{
    public $timestamps = false;
}
