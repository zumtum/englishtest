<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description_short',
        'type_slug',
        'duration',
        'scores',
        'published',
        'created_by',
        'modified_by'
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40) . '-' . Carbon::now()->format('dmyHi'), '-');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Question', 'quiz_questions');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
}
