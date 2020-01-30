<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Questions extends Model
{
    protected $fillable = ['title', 'slug', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //mutator always start with Set Attribute_name Attribute
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    //Accessor
    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers > 0) {
            if ($this->best_answer_id) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }
}
