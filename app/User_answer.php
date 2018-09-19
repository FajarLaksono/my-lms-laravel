<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_answer extends Model
{
    protected $fillable = ['user_id','answer_id'];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Test_answer(){
      return $this->hasOne(Test_answer::class);
    }
}
