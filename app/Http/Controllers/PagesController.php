<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Option;
use App\Http\Controllers\MasterController;
use Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index(){
        $courses = Course::orderBy('created_at', 'desc')->paginate(3);
        return view('index')->with('courses', $courses);
    }

    public function search(request $request, $cat){
        if($cat == 'user'){
            $result = user::where('name', 'like', '%'.$request->key.'%')->orderBy('created_at', 'desc')->paginate(6);
            User::setUserLog('search', 'user', $request->key);
        }else if($cat== 'course'){
            $result = course::where('title', 'like', '%'.$request->key.'%')->orderBy('created_at', 'desc')->paginate(6);
            user::setUserLog('search', 'course', $request->key);
        }else{
            $result = null;
        }
        return view('search')->with(['results' => $result, 'key' => $request->key, 'cat' => $cat]);
    }

    public function setWebInformation(){
        $web_option = MasterController::getWebInformations();
        return view('admin.webinformation')->with('web_info', $web_option);
    }

    public function storeWebInformation(request $request){
        //Validate request
        $this->validate($request, array(
          'title'       =>  'required|max:255',
          'description' =>  'sometimes|max:255',
        ));
        //new Option
        $option_title = option::where('option_name', 'web_title')->first();
        if(empty($option_title)){
            $option_title = new option;
        }
        $option_title->option_name = 'web_title';
        $option_title->option_value = $request->title;
        $option_title->autoload = 'y';
        $option_title->save();

        $option_description = option::where('option_name', 'web_description')->first();
        if(empty($option_description)){
            $option_description = new option;
        }
        $option_description->option_name = 'web_description';
        $option_description->option_value = $request->description;
        $option_description->autoload = 'y';

        //save data
        $option_description->save();
        //View course.show
        return redirect()->route('webinfo.edit');
    }
}
