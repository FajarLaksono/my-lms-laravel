<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_meta extends Model
{
    protected $fillable = ['user_id', 'meta_key', 'meta_value'];
    public function User(){
      return $this->belongsTo(User::class);
    }
}
