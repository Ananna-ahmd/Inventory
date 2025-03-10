<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\JWTToken;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    function UserRegistration(Request $request){
        try{
        $email=$request->input('email');
        $name=$request->input('name');
        $mobile=$request->input('mobile');
        $password=$request->input('password');

        User::create([
            'email'=>$email,
            'name'=>$name,
            'mobile'=>$mobile,
            'password'=>($password)
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'User Registered Successfully'],200);
    }
    catch(ValidationException $e){
        return response()->json([
            'status'=>'error',
            'message'=>$e->getMessage()
        ],500);

    }
}
function UserLogin(Request $request){
    $count=User::where('email','=',$request->input('email'))
         ->where('password','=',$request->input('password'))
         ->select('id')->first();

    if($count!==null){
    $token=JWTToken::CreateToken($request->input('email'),$count->id);
    return response()->json([
        'status'=>'success',
        'message'=>'User Logged In Successfully',
        'token'=>$token
    ],200)->cookie('token', $token, 60 * 24 * 30);

    }
    else{
        return response()->json([
            'status'=>'failed',
            'message'=>'Invalid Credentials'

        ],401);}
}

function UserLogout(){
return redirect('/')->cookie('token', '',-1);
}
}
