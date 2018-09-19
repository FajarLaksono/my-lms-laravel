<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('to', Auth::user()->id)->orWhere('from', Auth::user()->id)->orderBy('created_at', 'desc')->groupBy(DB::raw("`to`, `from`"))->get();
        $users = array();
        foreach($messages as $message){
            $user_target = $message->to==Auth::User()->id?$message->from:$message->to;
            if( !array_key_exists($user_target, $users) ){
                $get_user = user::find($user_target);
                $get_display_picture = $get_user->user_meta->where('meta_key', 'user_display_picture')->first()==null?'':$get_user->user_meta->where('meta_key', 'user_display_picture')->first()['meta_value'];
                $users[$get_user->id] =  array(
                                            'name' => $get_user->name,
                                            'user_display_picture' => $get_display_picture
                                        );
                //array_push($user, $datatopush);
            }
        }
        return view('message.index')->with(['messages' => $messages, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('user.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
          'new_message'       =>  'required|max:255',
        ));

        $message = new message;
        $message->to = $id;
        $message->from = Auth::user()->id;
        $message->text = $request->new_message;

        $message->save();

        return redirect()->route('message.show', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($the_id)
    {
        if($the_id != Auth::User()->id){
            $message = Message::where([['messages.from', Auth::user()->id], ['messages.to', $the_id]])
                              ->orWhere([['messages.from', $the_id], ['messages.to', Auth::user()->id]])
                              ->orderBy('created_at', 'asc')->get();
            $user = User::find($the_id);
            return view('message.show')->with(['messages' => $message, 'theuser' => $user]);
        }else{
            return view('message.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, array(
          'new_message'       =>  'required|max:255',
        ));

        $message = new message;
        $message->to = $id;
        $message->from = Auth::user()->id;
        $message->text = $request->new_message;

        $message->save();

        return redirect()->route('message.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
