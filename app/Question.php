<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'scores', 'type_slug', 'duration', 'created_by', 'modified_by'];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . '-' . Carbon::now()->format('dmyHi'), '-');
    }

    public function quizes()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
