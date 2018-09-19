<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_activity extends Model
{
    protected $fillable = ['user_id', 'description', 'object', 'value'];

    public function User(){
        return $this->belongsTo(User::class);
    }
}
