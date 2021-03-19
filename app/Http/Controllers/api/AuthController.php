<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Credenciales incorrectas', 401
            ]);
        }

        
        $user = $request->user();
        $tokenAuth = $user->createToken('Access Token');
        $token = $tokenAuth->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenAuth->accessToken,
            'token_type' => 'Bearer ',
            'expires_at' => Carbon::parse($tokenAuth->token->expires_at)->toDateTimeString()
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            $request->user()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
           'message' => 'Sesión cerrada con éxito'
        ]);
    }
}
