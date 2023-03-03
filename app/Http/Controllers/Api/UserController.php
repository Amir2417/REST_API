<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        try {
            return $this->ResponseWithSuccess($users,'Data not Found');
        } catch (\Throwable $th) {
            return $this->ResponseWithError([],$th->getMessage());
        }
    }
    public function show($id){
        $users = User::find($id);
        try {
            return $this->ResponseWithSuccess($users,"Hi $users->name");
        } catch (\Throwable $th) {
            return $this->ResponseWithError([],'user not found');
        }
    }
    public function registration(Request $request){
        //what is request in laravel?

        $validation =Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
        ]);
        if($validation->fails()){
            return $this->ResponseWithError([],$validation->errors());
        }
        try{
           $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            ]);
            return $this->ResponseWithSuccess($user,"hello $user->name");
        }catch(\Throwable $th){
            return $this->ResponseWithError([],$th->getMessage());
        }

    }
    //user login api
    public function login(Request $request){
        $credentials = $request->all();
        if (Auth::attempt($credentials)) {
            $user =Auth::user();
            $success = [
                'name'=>$user->name,
                'token'=>$user->createToken('accessToken')->plainTextToken,
            ];

            return $this->ResponseWithSuccess($success,"Login Successfull");
        } else {
            return $this->ResponseWithError([],"Unauthenticated");
        }
        //csrf- documentation

    }
    public function logout(){
        // $logout = Auth::user()->logout();
        // try {
        //     return $this->ResponseWithSuccess($logout,"Logout Successfully");
        // } catch (\Throwable $th) {
        //     return $this->ResponseWithError([],"Error");
        // }

        if (Auth::guard('sanctum')->check()) {
            $token = auth('sanctum')->user()->tokens()->delete();
            return $this->ResponseWithSuccess([],"Logout Successfully");
        } else {
            return $this->ResponseWithError([],"Error");
        }

    }
}

