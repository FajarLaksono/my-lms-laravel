<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_question extends Model
{
    protected $fillable = ['test_id', 'text', 'score'];

    public function Test_answer(){
        return $this->hasMany(Test_answer::class);
    }
    public function Test(){
        return $this->belongsTo(Test::class);
    }
}
