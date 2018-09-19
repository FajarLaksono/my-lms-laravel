<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Lesson;
use App\Course;
use Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function __construct()
    {
        //authentication
        $this->middleware('auth');
    }

    static function getLesson($course_id){
        //get Lesson
        return lesson::where('course_id', $course_id)->orderBy('position', 'ASC')->orderBy('published_at', 'ASC')->get();
    }

    public function index($course_slug){
        //Redirect to course
        return redirect()->route('course.index', $course_slug);
    }

    public function create($course_id){
        //View course create
        $course = course::find($course_id);
        return view('lesson.create')->with('course', $course);
    }

    public function store(Request $request, $course_id){
        //validation
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'slug'        =>  "required|min:6|max:255|alpha_dash|unique:lessons,slug",
          'position'    =>  'required',
          'image'       =>  'sometimes|image',
          'short_text'  =>  'required|max:255',
          'full_text'   =>  'required'
        ));
        //new Lesson
        $lesson = new Lesson;
        $lesson->course_id = $course_id;
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->position = $request->position;
        $lesson->short_text = $request->short_text;
        $lesson->full_text = $request->full_text;
        $lesson->published_at = date("Y-m-d H:i:s");
        //manage image
        if($request->hasFile('image')){
            $filename = time().$request->image->getClientOriginalName();
            $path = $request->image->move(public_path('media/images'),$filename);
            $lesson->image = $filename;
        }
        //save
        $lesson->save();
        //redirect
        return redirect()->route('lesson.show', [course::find($request->course_id)->slug, $request->slug]);
    }

    public function show($course_slug, $lesson_slug){
        //check authentication
        if( Auth::Check() ){
            //fetch course
            $course = Course::where('slug', $course_slug)->first();
            //Check Role
            if( auth::user()->getCourseRole($course->id) == 'admin' || auth::user()->getCourseRole($course->id) == 'student' ){
                $lesson = Lesson::where('slug', $lesson_slug)->first();
                $next = lesson::where([['course_id', '=', $course['id']], ['position', '>', $lesson->position]])->first(['title', 'slug']);
                $prev = lesson::where([['course_id', '=', $course['id']], ['position', '<', $lesson->position]])->orderBy('position', 'desc')->first(['title', 'slug']);
                //View Lesson.show
                return view('lesson.show')->with(['course' => $course, 'lesson' => $lesson, 'next_lesson' => $next, 'prev_lesson' => $prev]);
            }else{
                //Redirect
                return redirect()->route('course.show', $course_slug);
            }
        }
    }

    public function edit($course_id, $lesson_id){
        //Check authentication
        if( Auth::Check() ){
            //Check Role
            if( auth::user()->getCourseRole($course_id) == NULL || auth::user()->getCourseRole($course_id) == 'student' ){
                //view
                return view('error')->with(['alert' => 'Dilarang untuk menyunting, harap hubungi pemilik.', 'url' => route('course.show', [Course::find($course_id)->slug, Lesson::find($lesson_id)->slug])]);
            }else{
                //Fetch Data
                $lesson = lesson::find($lesson_id);
                $course = course::find($course_id);
                //View
                return view('lesson.edit')->with(['course' => $course, 'lesson' => $lesson]);
            }
        }else{
            //redirect
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $course_id, $lesson_id){
        //validation
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'slug'        =>  "required|min:6|max:255|alpha_dash|unique:lessons,slug,$lesson_id",
          'position'    =>  'required',
          'image'       =>  'sometimes|image',
          'short_text'  =>  'required|max:255',
          'full_text'   =>  'required'
        ));
        //fetch and edit
        $lesson = lesson::find($lesson_id);
        $lesson->course_id = $course_id;
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->position = $request->position;
        $lesson->short_text = $request->short_text;
        $lesson->full_text = $request->full_text;
        //manage image
        if($request->hasFile('image')){
            $filename = time().$request->image->getClientOriginalName();
            $path = $request->image->move('media/images',$filename);

            $oldImage = $lesson->image;
            $lesson->image = $filename;

            if(!empty($oldImage)){
                if( Storage::exists("images/$oldImage") ){
                    Storage::delete("images/$oldImage");
                }
            }
        }
        //save
        $lesson->save();
        //redirect
        return redirect()->route('lesson.show', [course::find($course_id)->slug, $lesson->slug]);
    }

    public function destroy($course_id, $lesson_id){
        //fetch
        $lesson = lesson::find($lesson_id);
        //manage image
        if(!empty($lesson->image)){
            if( Storage::exists("images/$lesson->image") ){
                Storage::delete("images/$lesson->image");
            }
        }
        //delete
        $lesson->delete();
        //redirect
        return redirect()->route('course.show', course::find($course_id)->slug);
    }
}
