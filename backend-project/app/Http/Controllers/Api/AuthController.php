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
    // public function login(Request $request) {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);
    
    //     try {
    //         $credentials = $request->only(['email', 'password']);
    
    //         if (!$token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'Unauthorized'], 401);
    //         }
    
    //         $user = JWTAuth::toUser($token);
    //         dd($user->status);

    //         if (!$user->status) {
    //             return response()->json(['error' => 'User is suspended'], 403);
    //         }else{
    //             return $this->respondWithToken($token);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Internal Server Error'], 500);
    //     }
    // }
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
    // public function me()
    // {
    //     $user = JWTAuth::user();
    
    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }
    
    //     if ($user->status) {
    //         return response()->json($user);
    //     } else {
    //         return response()->json(['error' => 'User is suspended'], 403);
    //     }
    // }

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
            'name' => 'required|min:5|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            'tel' => 'required|string|digits:10', 
            // 'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->tel = $request->get('tel');
        $user->profile_image = $request->file('profile_image');
        $user->password = bcrypt($request->get('password'));
        // if ($request->hasFile('profile_image')) {
        //     $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        //     $user->profile_image = $imagePath;
        // }
        $user->save();

        return response()->json(['message' => 'Registration successful', 'user' => $user], 201);
    }
}
