<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_role extends Model
{
  protected $fillable = [
      'user_id', 'course_id', 'role_status',
  ];
  protected $guarded = [
      'id', 'created_id', 'updated_at',
  ];

  public function User(){
    return $this->belongsTo(User::class);
  }

  public function Course(){
    return $this->belongsTo(Course::class);
  }
}
