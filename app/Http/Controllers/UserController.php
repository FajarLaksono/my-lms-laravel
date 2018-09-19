<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\User_meta;
use App\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = Auth::user()->orderBy('created_at', 'desc')->paginate(6);
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Not used
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->find($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->route('user.setting', [$id, 'information']);
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
        //
    }

    public function setting($id, $page = NULL){
        if ($page==NULL) {
            return redirect()->route('user.setting', [$id, 'information']);
        }

        if(strtolower($page)=='information'){
            $user_meta = User_meta::where('user_id', auth::user()->id)->get();
            return view('user.setting-information')->with('user_meta', $user_meta);
        }elseif(strtolower($page)=='security'){
            return view('user.setting-security');
        }elseif(strtolower($page)=='destroy'){
            return view('user.destroy');
        }else{
          return abort(404);
        }
    }

    public function saveSetting(Request $request, $id, $page){
        if(strtolower($page)=='information'){

            $this->validate($request, array(
              'bio'        =>   "sometimes|max:255",
              'image'      =>   'sometimes|image',
              'website'    =>   'sometimes'
            ));
            //setting name
            if(!empty($request->name)){
                if($request->name != Auth::user()->name){
                    $this->validate($request, array(
                       'name'       =>   'required'
                     ));

                    $user = user::find(Auth::user()->id);
                    $user->name = $request->name;
                    $user->save();
                }
            }
            //setting Bio
            $user_bio = User_meta::where( ['user_id' => auth::user()->id, 'meta_key' => 'user_bio'] )->first();
            if($user_bio === null){
                $user_bio = new User_meta;
                $user_bio->user_id = auth::user()->id;
                $user_bio->meta_key = 'user_bio';
                $user_bio->meta_value = $request->bio;
                $user_bio->save();
            }else{
                $user_bio->meta_value = $request->bio;
                $user_bio->save();
            }
            //setting display Picture
            if($request->hasFile('image')){
                $user_display_picture = User_meta::where( ['user_id' => auth::user()->id, 'meta_key' => 'user_display_picture'] )->first();
                if($user_display_picture === null){
                    $filename = time().$request->image->getClientOriginalName();
                    $path = $request->image->move(public_path('media/images'),$filename);

                    $user_display_picture = new User_meta;
                    $user_display_picture->user_id = auth::user()->id;
                    $user_display_picture->meta_key = 'user_display_picture';
                    $user_display_picture->meta_value = $filename;
                    $user_display_picture->save();

                }else{
                    $filename = time().$request->image->getClientOriginalName();
                    $path = $request->image->move('media/images',$filename);

                    $oldImage = $user_display_picture->meta_value;
                    $user_display_picture->meta_value = $filename;

                    if(!empty($oldImage)){
                        if( Storage::exists("images/$oldImage") ){
                            Storage::delete("images/$oldImage");
                        }
                    }

                    $user_display_picture->save();
                }
            }
            //setting website
            $user_website = User_meta::where( ['user_id' => auth::user()->id, 'meta_key' => 'user_website'] )->first();
            if($user_website === null){
                $user_website = new User_meta;
                $user_website->user_id = auth::user()->id;
                $user_website->meta_key = 'user_website';
                $user_website->meta_value = $request->website;
                $user_website->save();
            }else{
                $user_website->meta_value = $request->website;
                $user_website->save();
            }
            //setting display email
            $user_email = User_meta::where( ['user_id' => auth::user()->id, 'meta_key' => 'user_email'] )->first();
            if($user_email === null){
                $user_email = new User_meta;
                $user_email->user_id = auth::user()->id;
                $user_email->meta_key = 'user_email';
                $user_email->meta_value = $request->email;
                $user_email->save();
            }else{
                $user_email->meta_value = $request->email;
                $user_email->save();
            }
            return redirect()->route('user.setting', [$id, 'information']);

        }elseif(strtolower($page)=='security'){

            $messages = [
                'password.required' => 'Please enter current password',
            ];

            if (!empty($request->new_pass) || $request->email != Auth::user()->email) {
                $this->validate($request, array(
                    'password' => 'required',
                ), $messages);
                if(!empty($request->password)){
                    $theUser = user::find(auth::user()->id);

                    if(Hash::check($request->password, auth::user()->password)){
                        if($request->email != $theUser->email){
                            $this->validate($request, array(
                              'email'        =>   "required"
                            ));
                            $theUser->email = $request->email;
                        }

                        if(!empty($request->new_pass) && $request->new_pass != ''){
                            if($request->new_pass === $request->conf_new_pass){
                                if(!Hash::check($request->new_pass, auth::user()->password)){
                                    $this->validate($request, array(
                                      'new_pass' => 'sometimes|min:6',
                                      'conf_new_pass' => 'sometimes|min:6'
                                    ));
                                    $theUser->password = hash::make($request->new_pass);
                                }else{
                                    return redirect()->route('user.setting', [$id, 'security'])->withErrors('Looks you\'r not try to changing password');
                                }
                            }else{
                                return redirect()->route('user.setting', [$id, 'security'])->withErrors('The password that you inputed are not match.');
                            }
                        }
                        $theUser->save();
                        return redirect()->route('user.setting', [$id, 'security']);
                    }else{
                        return redirect()->route('user.setting', [$id, 'security'])->withErrors('Your password is not correct.');
                    }
                }else{
                    return redirect()->route('user.setting', [$id, 'security'])->withErrors('Please enter current password.');
                }
            }else{
                return redirect()->route('user.setting', [$id, 'security'])->withErrors('Nothing to save.');
            }

        }elseif(strtolower($page)=='destroy'){

            $messages = [
                'password.required' => 'Please enter current password',
            ];
            $this->validate($request, array(
                'password' => 'required',
            ), $messages);

            if(!empty($request->password)){
                $theUser = user::find(auth::user()->id);

                if(Hash::check($request->password, auth::user()->password)){
                    if($this->destroy($theUser)){
                        return redirect()->route('index');
                    }else{
                        return redirect()->route('user.setting', [$id, 'destroy'])->withErrors('Your action is denied, please try again leter.');
                    }
                }else{
                      return redirect()->route('user.setting', [$id, 'destroy'])->withErrors('Your password is not correct.');
                }
            }else{
                return redirect()->route('user.setting', [$id, 'destroy'])->withErrors('Your password is empty.');
            }

        }else{

            return abort(404);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->first();
        $user->delete();

        if( message::where('to', $id->id)->orWhere('from', $id->id)->get()->isNotEmpty() ){
            $messages = message::where('to', $id)->orWhere('from', $id);
            $messages->delete();
        }
        
        return 1;
    }
}
