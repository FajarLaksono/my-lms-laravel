<?php

namespace App\Http\Controllers;
use Auth;
use App\Course_role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth::user()->course_role()->get();
        return view('home')->with(['role' => $role]);
    }
}
