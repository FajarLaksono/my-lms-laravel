<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_meta extends Model
{
    protected $fillable =['test_id', 'meta_key', 'meta_value'];
    public function Test(){
        return $this->belongsTo(Test::class);
    }
}
