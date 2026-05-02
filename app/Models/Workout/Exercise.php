<?php

namespace App\Models\Workout;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('name', 'description', 'icon_path', 'public')]
class Exercise extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
