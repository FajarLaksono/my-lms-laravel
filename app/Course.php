<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image', 'published_at'];

    public function Course_meta(){
      return $this->hasMany(Course_meta::class);
    }

    public function Course_role(){
      return $this->hasMany(Course_role::class);
    }

    public function Lesson(){
      return $this->hasMany(Lesson::class);
    }
}
