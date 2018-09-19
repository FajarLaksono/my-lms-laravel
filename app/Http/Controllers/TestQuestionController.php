<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Test;
use App\Test_question;
use App\Test_answer;
use Auth;
class TestQuestionController extends Controller
{
    public function __construct()
    {
        //Authentication area
        $this->middleware('auth');
    }

    static function getQuestion($test_id){
        //fetch data
        $questions = test_question::where('test_id', $test_id)->orderBy('created_at', 'asc')->get();
        return $questions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_slug, $lesson_slug, $test_slug)
    {
        //Redirect
        return redirect()->route('test.show', [$course_slug, $lesson_slug, $test_slug]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $lesson_id, $test_id)
    {
        //Fetch
        $course = course::find($course_id);
        $lesson = lesson::find($lesson_id);
        $test = test::find($test_id);
        //Send to view
        return view('question.create')->with(['course' => $course, 'lesson'=>$lesson, 'test'=>$test]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id, $lesson_id, $test_id)
    {
      //Validation
      $this->validate($request, array(
        'question_score'       =>  'required|max:3',
        'question_text'        =>  'required|max:255',
        'answer_text1'         =>  'required|max:255',
        'answer_text2'         =>  'required|max:255',
        'answer_text3'         =>  'required|max:255',
        'answer_text4'         =>  'required|max:255',
        'answer_text5'         =>  'required|max:255',
      ));
      //new
      $question = new Test_question;
      //insert
      $question->test_id = $test_id;
      $question->text = $request->question_text;
      $question->score = $request->question_score;
      //Save
      $question->save();

      //insert to answer table
      $answer_data = array(
          array('test_question_id'=>$question->id, 'text'=> $request->answer_text1, 'correct'=>1),
          array('test_question_id'=>$question->id, 'text'=> $request->answer_text2, 'correct'=>0),
          array('test_question_id'=>$question->id, 'text'=> $request->answer_text3, 'correct'=>0),
          array('test_question_id'=>$question->id, 'text'=> $request->answer_text4, 'correct'=>0),
          array('test_question_id'=>$question->id, 'text'=> $request->answer_text5, 'correct'=>0),
      );
      Test_answer::insert($answer_data); // Eloquent approach
      //redirect
      return redirect()->route('test.show', [course::find($course_id)->slug, lesson::find($lesson_id)->slug, test::find($test_id)->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($test_id)
    {
        //empty
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $lesson_id, $test_id, $question_id)
    {
        //check Authentication
        if( Auth::Check() ){
            //check user role
            if( auth::user()->getCourseRole($course_id) == NULL || auth::user()->getCourseRole($course_id) == 'student' ){
                //view
                return view('error')->with(['alert' => 'Dilarang untuk menyunting, harap hubungi pemilik.', 'url' => route('course.show', [Course::find($course_id)->slug, Lesson::find($lesson_id)->slug])]);
            }else{
                //fetch
                $lesson = lesson::find($lesson_id);
                $course = course::find($course_id);
                $test = test::find($test_id);
                $question = test_question::find($question_id);
                $answers = Test_answer::where('test_question_id', $question_id)->orderBy('correct', 'desc')->get();
                //send to view
                return view('question.edit')->with(['course' => $course, 'lesson' => $lesson, 'test' => $test, 'question' => $question, 'answers' => $answers]);
            }
        }else{
            //redirect
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
    public function update(Request $request, $course_id, $lesson_id, $test_id, $question_id)
    {
      //update test
      $this->validate($request, array(
        'question_score'       =>  'required|max:3',
        'question_text'        =>  'required|max:255',
        'answers'              =>  'required|max:255'
      ));
      //fetch
      $question = Test_question::find($question_id);
      //insert question table
      $question->test_id = $test_id;
      $question->text = $request->question_text;
      $question->score = $request->question_score;
      //save
      $question->save();

      foreach($request->answers as $r_answer){
          //fetch
          $answer = Test_answer::find($r_answer['id']);
          //insert
          $answer->text = $r_answer['text'];
          $answer->correct = $r_answer['correct'];
          //save
          $answer->save();
      }
      //redirect
      return redirect()->route('test.show', [course::find($course_id)->slug, lesson::find($lesson_id)->slug, test::find($test_id)->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $lesson_id, $test_id, $question_id)
    {
        //fetch
        $question = test_question::find($question_id);
        //delete
        $question->delete();
        //redirect
        return redirect()->route('test.show', [course::find($course_id)->slug, lesson::find($lesson_id)->slug, test::find($test_id)->slug]);
    }
}
