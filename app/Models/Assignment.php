<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Assignment extends Model
{
    protected $fillable = ['quiz_id', 'sended'];

    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class, 'id', 'quiz_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assignment_user');
    }
}
