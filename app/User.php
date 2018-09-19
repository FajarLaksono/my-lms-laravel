<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Course;
use App\User_activity;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function User_meta(){
      return $this->hasMany(User_meta::class);
    }
    public function Course_role(){
      return $this->hasMany(Course_role::class);
    }
    public function User_answer(){
      return $this->hasMany(User_answer::class);
    }
    public function User_activity(){
      return $this->hasMany(User_activity::class);
    }


    public function getCourseRole($course_id){
      $result = null;
      if(!empty(count($this->course_role()->get()) )){
          $result = $this->course_role()->where('course_id', $course_id)->first()['role_status'];
      }
      return $result;
    }
    public function getCourseRoleBySlug($course_slug){
        $course_id = null;
        $result = null;
        if(!course::where('slug', $course_slug)->get()->isEmpty()){
          $course_id = course::where('slug', $course_slug)->first()->id;
        }
        if( !empty(count($this->course_role()->get())) ){
          $result = $this->course_role()->where( 'course_id', $course_id )->first()['role_status'];
        }
        return $result;
    }
    public function isWebAdmin(){
        $result = $this->User_meta()->where('meta_key', 'web_role')->first()['meta_value'];
        return $result;
    }
    static function setUserLog($description, $object, $value){
        if(auth::check()){
            try {
                $new_activity = new User_activity;
                $new_activity->user_id = auth::user()->id;
                $new_activity->description = $description;
                $new_activity->object = $object;
                $new_activity->value = $value;
                $new_activity->save();
            } catch (Exception $e) {
                return false;
            }
        }

        return true;
    }
}
