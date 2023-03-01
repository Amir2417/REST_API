<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
