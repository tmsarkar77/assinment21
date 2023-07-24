<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//routing page
Route::get('/login',[HomeController::class,'loginPage'])->name('login');
Route::get('/register',[HomeController::class,'registerPage'])->name('registerPage');
Route::get('/sendOtpToUserEmail',[HomeController::class,'sendOtpToUserEmail'])->name('sendOtpToUserEmail');

//api
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'sendOtpCode']);
Route::post('/verify-otp',[UserController::class,'OtpVerify']);
Route::post('/reset-password',[UserController::class,'ReSetPass'])
    ->middleware(TokenVerificationMiddleware::class);