<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['course_id', 'title', 'slug', 'position', 'image', 'short_text', 'full_text', 'published_at'];

    public function Course(){
        return $this->belongsTo(Course::class);
    }

    public function Lesson_meta(){
        return $this->hasMany(Lesson_meta::class);
    }

    public function Test(){
        return $this->hasOne(Test::class);
    }
}
