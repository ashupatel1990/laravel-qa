<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = ['body', 'user_id'];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public static function boot()
    {
        parent::boot();

        // static::created(function ($answers) {
        //     dd($answers->question);
        //     $answers->questions->increment('answers_count');
        //     $answers->questions->save();            
        // });  
    }
}
