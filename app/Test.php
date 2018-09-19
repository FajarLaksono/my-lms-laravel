<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['lesson_id', 'title', 'description', 'published_at'];
    public function Test_meta(){
        return $this->hasMany(Test_meta::class);
    }
    public function Test_question(){
        return $this->hasMany(Test_question::class);
    }
    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
