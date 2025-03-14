<?php

use App\Http\Middleware\TokenVerificationMiddleWare;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
route::get('/', function () {
return view('OTPMail');
});
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::get('/logout', [UserController::class, 'UserLogout']);
Route::get('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleWare::class]);
