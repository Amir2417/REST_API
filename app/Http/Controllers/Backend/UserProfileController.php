<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
class UserProfileController extends Controller
{
    public function logout(){
        Auth::logout();
        return Redirect()->route('login');
    }
    public function user_profile(){
        $data = Auth::user();
        return view('backend.user_profile.user_profile_view',compact('data'));
    }
    public function user_profile_edit(){
        $data = Auth::user();
        return view('backend.user_profile.user_profile_edit',compact('data'));
    }
    public function sample(){
        // $log_user = Auth::user();
        return view('backend.user_profile.sample');
    }
    public function update(Request $request ){
        $data = Auth::user();
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_photo_path')){
            $file = $request->file('profile_photo_path');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path'] = $filename;
        }
        $data->save();
        return Redirect()->route('user.profile');
    }
}
