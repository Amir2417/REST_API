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
}
