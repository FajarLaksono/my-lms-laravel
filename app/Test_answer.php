<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_answer extends Model
{
    protected $fillable = ['test_question_id','text','correct'];
    public function Test_question(){
        return $this->belongsTo(Test_question::class);
    }
    public function User_answer(){
        return $this->hasMany(User_answer::class);
    }
}
