<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = ['body', 'user_id'];

    protected $appends = ['created_date'];

    public function questions()
    {
        return $this->belongsTo(Questions::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
    
    public static function boot()
    {
        parent::boot();

        static::created(function ($answers) {
             $answers->questions->increment('answers_count');
        });

        static::deleted(function ($answers) {
            $answers->questions->decrement('answers_count');
        });
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        //   dd($this->questions);
        // return 'vote-accepted';
        return $this->isBest() ? 'vote-accepted' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->id === $this->questions->best_answer_id;
    }

    public function votes()
    {
        return $this->morphToMany(User::class, 'votable');
    }
}
