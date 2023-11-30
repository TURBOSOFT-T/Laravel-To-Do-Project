<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Validator;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Passport\Client as OClient; 
use GuzzleHttp\Client;
use Guzzle\Http\EntityBody;
use GuzzleHttp\Client as GuzzleHttp;

use Guzzle\Http\Message\Response;




class AuthController extends Controller
{
    /**
     * Registration Req
     */



    public $successStatus = 200;

    public function register(Request $request)
    {
        /* $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
 
        $token = $user->createToken('Laravel8PassportAuth')->accessToken;
 
        return response()->json(['token' => $token], 200); */

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['data' => $user]);
    }
 


    /**
     * Login Req
     */


    public function login(Request $request)
    {
          $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }  
     
    }



   






    public function details() { 
        $user = Auth::user(); 
        return response()->json($user, $this->successStatus); 
    } 



    public function unauthorized() { 
        return response()->json("unauthorized", 401); 
   } 
   






    public function logout(Request $request) {
 
        $request->user()->token()->revoke();
      return response()->json([  'message' => 'Successfully logged out' ]);
    }





    
    public function refreshtoken(Request $request) { 
        

        
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $baseUrl = url('/');
        $response = Http::post("{$baseUrl}/oauth/token", [
            'refresh_token' => $request->refresh_token,
            'client_id' => config('passport.password_grant_client.id'),
            'client_secret' => config('passport.password_grant_client.secret'),
            'grant_type' => 'refresh_token'
        ]);

        $result = json_decode($response->getBody(), true);
        if (!$response->ok()) {
            return response()->json(['error' => $result['error_description']], 401);
        }
        return response()->json($result);
    }



    

}