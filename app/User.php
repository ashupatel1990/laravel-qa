<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['avatar', 'url'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

    public function getUrlAttribute()
    {
        return "#";
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?&s=" . $size;
    }

    public function favourites()
    {
        return $this->belongsToMany(Questions::class, 'favourites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Questions::class, 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answers::class, 'votable');
    }
}
