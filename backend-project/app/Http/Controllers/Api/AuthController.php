<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
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
        try {
            $newToken = JWTAuth::refresh();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token refresh failed'], 401);
        }

        return $this->respondWithToken($newToken);
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
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tel' => 'nullable|digits:10',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->tel = $request->get('tel');
        $user->profile_picture = $request->file('profile_picture');
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
    }
}
