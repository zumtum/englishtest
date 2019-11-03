<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['quiz_id', 'sended'];

    public function quiz()
    {
        return $this->hasOne('App\Quiz', 'id', 'quiz_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'assignment_user');
    }
}
