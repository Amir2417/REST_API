<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ResponseWithSuccess($data,$message){
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'message'=>$message,
            'status'=>200
        ]);
    }
    public function ResponseWithError($data,$message){
        return response()->json([
            'success'=>false,
            'data'=>$data,
            'message'=>$message,
            'status'=>404
        ]);
    }
}
