<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

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
            'password'=>bcrypt($password)
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'User Registered Successfully'],200);
    }
    catch(Exception $e){
        return response()->json([
            'status'=>'error',
            'message'=>$e->getMessage()
        ],500);

    }
}
}
