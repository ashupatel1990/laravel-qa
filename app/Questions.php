<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Questions extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'answers_count'];

    protected $appends = ['created_date', 'body_html'];
    
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
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    public function acceptBestAnswer(Answers $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function favourites()
    {
        return $this->belongsToMany(User::class, 'favourites')->withTimestamps(); //, 'question_id', 'user_id');
    }

    public function isFavourited()
    {
        return $this->favourites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute()
    {
        return $this->favourites->count();
    }
}
