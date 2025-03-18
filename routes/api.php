<?php

use App\Http\Middleware\TokenVerificationAPIMiddleWare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/logout', [UserController::class, 'UserLogout']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationAPIMiddleWare::class]);
Route::get('/user', [UserController::class, 'UserProfile'])->middleware([TokenVerificationAPIMiddleWare::class]);
Route::PUT('/user-update', [UserController::class, 'UpdateUserProfile'])->middleware([TokenVerificationAPIMiddleWare::class]);
