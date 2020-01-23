<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Questions extends Model
{
    protected $fillable = ['title', 'slug'];

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
}
