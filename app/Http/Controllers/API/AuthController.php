<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        try {
            if (! $token = Auth::attempt($request->all())) {
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        }
        catch(Exception $e) {
            $this->incrementLoginAttempts($request);
            return response()->json(['error' => 'Could Not Create Token'], 500);
        }


        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token')->plainTextToken;

        return $this->respondWithToken($token);
    }

    public function register(RegisterRequest $request)
    {
        try {
            User::create($request->all());
        }
        catch(Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }

        return response()->json([
            'message' => 'Successfully Registered.',
        ]);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => Auth::user()->name,
            // 'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully Logout',
        ]);
    }
}
