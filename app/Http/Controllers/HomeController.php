<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('pages.dashboard');
    }
    public function loginPage(){
        return view('pages.auth.login');
    }

    public function registerPage(){
        return view('pages.auth.register');
    }

   

    public function sendOtpToUserEmail(){
        return view('pages.auth.sendotptoemmail');
    }
}
