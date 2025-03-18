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
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/user', [UserController::class, 'UserProfile'])->middleware([TokenVerificationMiddleWare::class]);
Route::PUT('/user-update', [UserController::class, 'UpdateUserProfile'])->middleware([TokenVerificationMiddleWare::class]);
