<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{


    function UserRegistration(Request $request){
        try{

            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
               ]);
    
               return response()->json([
                'status'=>'success',
                'message' => 'User Registration Succcessfuly'
                ]);

        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message' => $e->getMessage()
                ]);
        }
          
    }

    function UserLogin(Request $request){

        $counts =  User::where('email','=',$request->input('email'))
        ->where('password','=',$request->input('password'))
        ->count();
    
        if($counts==1){
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status'=>'success',
                'message' => 'User Login Succcessfuly',
                'token'=> $token
                ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message' => 'User Login Failed'
                ]);
        }
    }

    function sendOtpCode(Request $request){

        $email = $request->input('email');
        $otp = rand(1000,9999);
        $res = User::where('email','=',$email)->count();

        if($res==1){
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email','=',$email)->update(['otp'=>$otp]);

                return response()->json([
                    'status'=>'success',
                    'message' => '4 Digit OTP Code has been Send To Your Email'
                    ]);
        }else{

            return response()->json([
                'status'=>'failed',
                'message' => 'Unothorize'
                ]);

        }

    }


    function OtpVerify(Request $request){
      
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email','=',$email)
                ->where('otp','=', $otp)
                ->count();

        if($count==1){

            User::where('email','=',$email)->update(['otp'=>'0']);
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status'=>'success',
                'message' => 'OTP Verification Successfull',
                'token'=> $token
            ]);

        }else{
            return response()->json([
                'status'=>'failed',
                'message' => 'Unothorize'
                ]);
        }

    }

    function ReSetPass(Request $request){

        try{
            $email = $request->header('email');
           
            $password = $request->input('password');
            User::where('email','=',$email)->update(['password'=>$password]);

            return response()->json([
                'status'=>'success',
                'message' => 'Password Reset Succcessfuly'
                ]);
        }catch(Exception $e){

            return response()->json([
                'status'=>'failed',
                'message' => 'Password Reset Failed'
                ]);
                
        }
    }

}
