<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\Lesson;
use App\Course;
use App\Test_answer;
use App\User_answer;
use App\Http\Controllers\TestQuestionController;
use Auth;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($course_slug, $lesson_slug){
      //redirect to course
      return redirect()->route('course.show', $course_slug);
    }
    public function selectLesson($course_id){
        $course = course::find($course_id);
        $lesson = $course->lesson()->orderBy('position', 'asc')->get();
        return view('test.selectLesson')->with([ 'course' => $course, 'lessons' => $lesson ]);
    }
    public function create($course_id, $lesson_id){
      //creat newe test
      $course = course::find($course_id);
      $lesson = lesson::find($lesson_id);
      return view('test.create')->with(['course' => $course, 'lesson' => $lesson]);
    }
    public function store(Request $request, $course_id, $lesson_id){
        //storing new test
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'slug'        =>  "required|min:6|max:255|alpha_dash|unique:tests,slug",
          'position'    =>  'required',
          'description' =>  'required'
        ));

        $test = new test;
        $test->lesson_id = $lesson_id;
        $test->title = $request->title;
        $test->slug = $request->slug;
        $test->position = $request->position;
        $test->description = $request->description;
        $test->published_at = date("Y-m-d H:i:s");

        $test->save();

        return redirect()->route('test.show', [course::find($course_id)->slug, lesson::find($lesson_id)->slug, $request->slug]);
    }
    public function edit($course_id, $lesson_id, $test_id){
      //edit
      if( Auth::Check() ){
          if( auth::user()->getCourseRole($course_id) == NULL || auth::user()->getCourseRole($course_id) == 'student' ){
              return 'Forbidden to editing this test, you need permission from author.';
          }else{
              $lesson = lesson::find($lesson_id);
              $course = course::find($course_id);
              $test = test::find($test_id);
              return view('test.edit')->with(['course' => $course, 'lesson' => $lesson, 'test' => $test]);
          }
      }else{
          return redirect()->route('login');
      }
    }
    public function update(Request $request, $course_id, $lesson_id, $test_id){
      //update test
      $this->validate($request, array(
        'title'       =>  'required|max:255',
        'slug'        =>  "required|min:6|max:255|alpha_dash|unique:tests,slug,$test_id",
        'position'    =>  'required',
        'description' =>  'required'
      ));

      $test = test::find($test_id);
      $test->lesson_id = $lesson_id;
      $test->title = $request->title;
      $test->slug = $request->slug;
      $test->position = $request->position;
      $test->description = $request->description;

      $test->save();
      return redirect()->route('test.show', [course::find($course_id)->slug, lesson::find($lesson_id)->slug, $request->slug]);
    }
    public function destroy($course_id, $lesson_id, $test_id){
      //destroy
      $test = test::find($test_id);

      $test->delete();

      return redirect()->route('course.show', course::find($course_id)->slug);
    }
    public function show($course_slug, $lesson_slug, $test_slug){
      //going to get test
      $course = course::where('slug', $course_slug)->first();
      $lesson = lesson::where('slug', $lesson_slug)->first();
      $test = test::where('slug', $test_slug)->first();

      //Load questions and answere
      $questions = TestQuestionController::getQuestion($test->id);

      //Throw it to view of show
      return view('test.show')->with(['course' => $course, 'lesson' => $lesson, 'test' => $test, 'questions' => $questions]);
    }
    public function submit(request $request, $course_id, $lesson_id, $test_id){
      //storing new test
      $this->validate($request, array(
        'question'       =>  'required',
      ));

      $isValid = true;
      foreach ($request->question as $quest) {
        if(!array_key_exists('answer', $quest)){
          $isValid = false;
        }
      }
      if($isValid){
          foreach ($request->question as $quest) {
              foreach( test_answer::where('test_question_id', $quest['id'])->get() as $test_answer ){
                  if(!$test_answer->user_answer()->where('user_id', auth::user()->id)->get()->isEmpty()){
                      $test_answer->user_answer()->where('user_id', auth::user()->id)->first()->delete();
                  }else{

                  }
              }

              $user_answer = new user_answer;
              $user_answer->user_id = auth::user()->id;
              $user_answer->test_answer_id = $quest['answer'];
              $user_answer->save();
          }
      }else{
          return back()->withErrors('The question field is required.');
      }

      return redirect()->route('course.result', [$course_id]);
    }
}
