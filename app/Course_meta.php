<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_meta extends Model
{
    protected $fillable = [
        'course_id', 'meta_key', 'meta_value',
    ];

    public function Course(){
        return $this->belongsTo(Course::class);
    }
}
