<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
     public function login(Request $request){
         try{
            $validator = Validator::make($request->all(),[
               'username' => 'required',
                'password' => 'required',
            ]);
            if($validator->fails()){
                return $this->fail($validator->errors(), $validator->messages(),"Fail",401);
            }
            $username = $request->get('username');
            $password = $request->get('password');
            $credentials = ['username' =>$username , 'password' => $password ];
            if(!Auth::attempt($credentials)){
                return response()->json([
                   'message' => " Username or password incorrect ! " ,
                ],401);
            }
            $user = Auth::user();
            $tokenResult = $user->createToken("Personal Access Token");
            $token = $tokenResult->token;
            if($request->has('remember_me')){
                $token->expires_at = Carbon::now()->addWeek(1);

            }
            $token->save();
            $user->token_type = "Bearer";
            $user->access_token = $tokenResult->accessToken;
            $user->expires_at = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
            $user->store;

            return $this->success($user, "Login success");

         }
         catch (\ Exception $e){
             return $this->error($e);
         }
     }
}
