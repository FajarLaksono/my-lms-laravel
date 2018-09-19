<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
//model
use App\Course;
use App\Course_role;
use App\Test;
//Controller
use App\Http\Controllers\LessonController;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //Fetch all data from course table
        $courses = Course::orderBy('created_at', 'desc')->paginate(6);
        //send it into course.index view
        return view('course.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //View course.create
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate request
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'slug'        =>  "required|min:6|max:255|alpha_dash|unique:courses,slug",
          'description' =>  'required',
          'image'       =>  'sometimes|image'
        ));
        //new Course
        $course = new Course;
        $course->title = $request->title;
        $course->slug = $request->slug;
        $course->description = $request->description;
        //manage image
        if($request->hasFile('image')){
            $filename = time().$request->image->getClientOriginalName();
            $path = $request->image->move(public_path('media/images'),$filename);
            $course->image = $filename;
        }
        //save data of Course
        $course->save();
        //new Course Role
        $course_role = new Course_role;
        $course_role->user_id = Auth::user()->id;
        $course_role->course_id = $course->id;
        $course_role->role_status = 'admin';
        //save Data of Course Role
        $course_role->save();
        //View course.show
        return redirect()->route('course.show', $course->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //Fecth Data and send it to view
        $course = Course::where('slug', $slug)->first();
        if(empty($course)){
            return abort('404');
        }
        return view('course.show')->with(['course' => $course, 'lessons' => LessonController::getLesson($course->id), 'tests' => Test::get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Authentication
        if( Auth::Check() ){
            //Check Owner
            if( auth::user()->getCourseRole($id) == 'student' ){
                return view('error')->with(['alert' => 'Dilarang untuk menyunting, harap hubungi pemilik.', 'url' => route('course.show', Course::find($id)->slug)]);
            }else{
                $course = Course::find($id);
                return view('course.edit')->with('course', $course);
            }
        }else{
            //Redirect to login
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation requests
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'slug'        =>  "required|min:6|max:255|alpha_dash|unique:courses,slug,$id",
          'description' =>  'required',
          'image'       =>  'sometimes|image'
        ));
        //new course
        $course = Course::find($id);
        $course->title = $request->title;
        $course->slug = $request->slug;
        $course->description = $request->description;
        //manage image
        if($request->hasFile('image')){
            $filename = time().$request->image->getClientOriginalName();
            $path = $request->image->move('media/images',$filename);

            $oldImage = $course->image;
            $course->image = $filename;

            if(!empty($oldImage)){
                if( Storage::exists("images/$oldImage") ){
                    Storage::delete("images/$oldImage");
                }
            }
        }
        //save course data
        $course->save();
        //redirect to course.show
        return redirect()->route('course.show', $course->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fetch course data
        $course = course::find($id);
        $course_role = course_role::where('course_id', $course->id);
        $course_role->delete();
        //manage image
        if(!empty($course->image)){
            if( Storage::exists("images/$course->image") ){
                Storage::delete("images/$course->image");
            }
        }
        //delete data
        $course->delete();
        //redirect
        return redirect()->route('course.index');
    }

    public function setStudentBySlug(request $request, $course_slug){
        //Validate request
        //...
        //new Course Role
        $course = Course::where('slug', $course_slug)->first();
        $course_role = new Course_role;
        $course_role->user_id = Auth::user()->id;
        $course_role->course_id = $course->id;
        $course_role->role_status = 'student';
        //save Data of Course Role
        $course_role->save();
        //View course.show
        return redirect()->route('course.show', $course->slug);
    }

    public function getCourseResult($slug){
        $course = Course::where('slug', $slug)->first();
        if(empty($course)){
            return abort('404');
        }
        return view('course.result')->with(['course' => $course, 'lessons' => LessonController::getLesson($course->id)]);
    }
}
