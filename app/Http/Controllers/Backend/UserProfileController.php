<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
    public function update(Request $request ){
        //Request $request - User give the http request for accept this request we use Request class

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
    public function change_password(){
        $user = Auth::user();
        return view('backend.user_profile.user_change_password',compact('user'));
    }
    public function change_password_update(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required',
        ]);
        $current_password = Auth::user()->password;
        if(Hash::check($request->current_password,$current_password)){
            $password =$request->password;
            $password_confirmation =$request->password_confirmation;
            if($password === $password_confirmation ){
                $user = Auth::user();
                $user ->password = Hash::make($request->password);
                $user->save();
                Auth::logout();

                return Redirect()->route('login');
            }
            else{
                return Redirect()->back();
            }
        }else{
            return Redirect()->back();
        }
    }
}
