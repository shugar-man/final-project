<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request) {
        $request ->validate([
            'email' =>['required','email'],
            'password' =>['required']
        ]);
        $credentials = $request->only(['email','password']);
        if (!$token = JWTAuth::attempt($credentials)) {
            
            return response()->json(['error'=>'Unauthorized'],401);
        }
        return $this->respondWithToken($token);

    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    public function me()
    {
        return response()->json(JWTAuth::user());
    }

     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
