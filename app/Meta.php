<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = ['meta_key', 'meta_value', 'meta_other'];
}
