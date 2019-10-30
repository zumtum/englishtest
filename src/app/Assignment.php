<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['quiz_id', 'sended'];

    public function quiz()
    {
        return $this->hasOne('App\Quiz');
    }
}
