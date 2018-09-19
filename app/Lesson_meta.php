<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson_meta extends Model
{
    protected $fillable = ['course_id', 'meta_key', 'meta_value'];

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }
}
