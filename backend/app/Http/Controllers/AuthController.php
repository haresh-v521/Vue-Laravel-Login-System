<?php

namespace App\Http\Controllers;

// use App\Http\Requests\LoginRequest;
// use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class AuthController extends Controller
{
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|required_with:password_confirmation|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
 
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = null;

        try {
            if (!$token = \JWTAuth::attempt($credentials)) {
                return response()->json([
                'success' => false,
                'errors' => [
                    'message' => [
                        'Either Email or Password Invalid'
                    ]
                ],
                ]);
            }
        } catch (\JWTAuthException $e) {
            return response()->json([
                'success' => false,
                'errors' => [
                'message' => [
                    'Either Email or Password Invalid'
                    ]
                ],
            ]);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $user = Auth::user();

        return response()->json([
        'success' => true,
        'access_token' => $token,
        'user' => $user,
        'token_type' => 'bearer',
        ]);
    }
    public function logout()
    {
        \JWTAuth::invalidate(\JWTAuth::getToken());
            return response()->json([
            'success' => true
            ]);
    }
}
